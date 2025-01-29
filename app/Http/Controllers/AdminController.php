<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Proposal;
use App\Models\LPJ;
use App\Models\Catatan;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboardadmin()
    {
        // Validasi admin dan dashboard
        $validAdmins = ['Frontoffice', 'Manager', 'Keuangan', 'Program', 'BP', 'superadmin'];
        $validDashboards = ['dashboard', 'detail', 'laporan'];

        // Cek apakah admin dan dashboard valid
        if (!in_array(Auth::guard('admin')->user()->role, $validAdmins)) {
            abort(404, "Halaman tidak ditemukan.");
        }

        // Ambil data mitra
        $mitras = Mitra::all();

        // Ambil data proposal
        $proposals = Proposal::all();

        // Rentang 12 bulan terakhir
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Buat array dengan semua bulan dalam format 'YYYY-MM'
        $months = [];
        $current = $startDate->copy();
        while ($current->lte($endDate)) {
            $months[$current->format('Y-m')] = 0; // Inisialisasi dengan 0
            $current->addMonth();
        }

        // Data Proposal Bulanan
        $proposalData = Proposal::selectRaw('YEAR(tgl_acc) as year, MONTH(tgl_acc) as month, COUNT(*) as total')
            ->whereBetween('tgl_acc', [$startDate, $endDate])
            ->where('status', 'Diterima')
            ->groupByRaw('YEAR(tgl_acc), MONTH(tgl_acc)')
            ->get();

        foreach ($proposalData as $proposal) {
            $key = sprintf('%04d-%02d', $proposal->year, $proposal->month); // Format 'YYYY-MM'
            $months[$key] = $proposal->total;
        }

        $formattedMonthlyProposals = $months;

        // Data Anggaran Disetujui
        $budgetData = Proposal::selectRaw('YEAR(tgl_acc) as year, MONTH(tgl_acc) as month, SUM(anggaran_disetujui) as total')
            ->whereBetween('tgl_acc', [$startDate, $endDate])
            ->where('status', 'Diterima')
            ->groupByRaw('YEAR(tgl_acc), MONTH(tgl_acc)')
            ->get();

        $budgetMonths = $months; // Gunakan template bulan yang sama
        foreach ($budgetData as $budget) {
            $key = sprintf('%04d-%02d', $budget->year, $budget->month);
            $budgetMonths[$key] = $budget->total;
        }

        $formattedApprovedBudgets = $budgetMonths;

        // Diagram Pilar: Proposal dengan status "Diterima" dikelompokkan berdasarkan kolom "pilar"
        $validPilars = ['Pendidikan', 'Kemanusiaan', 'Dakwah', 'Ekonomi', 'Kesehatan', 'Lingkungan'];

        // Ambil data pilar dari database
        $pillarData = Proposal::selectRaw('pilar, COUNT(*) as total')
            ->where('status', 'Diterima')
            ->groupBy('pilar')
            ->pluck('total', 'pilar');

        // Inisialisasi semua pilar dengan nilai 0
        $formattedPillarData = [
            'labels' => $validPilars,
            'values' => array_fill(0, count($validPilars), 0),
        ];

        // Isi nilai untuk pilar yang memiliki data
        foreach ($pillarData as $pilar => $total) {
            if (in_array($pilar, $validPilars)) {
                $index = array_search($pilar, $validPilars);
                $formattedPillarData['values'][$index] = $total;
            }
        }

        return view("admin.dashboard", compact('mitras', 'proposals', 'formattedMonthlyProposals', 'formattedPillarData', 'formattedApprovedBudgets'));
    }

    //INDEX UNTUK ADMIN
    public function indexmitra(){
        $mitras = Mitra::paginate(10);
        $allMitras = Mitra::all();

        return view('admin.indexmitra', compact('mitras', 'allMitras'));
    }

    public function indexproposal($admin){
        if ($admin === 'admin') {
            // Jika admin, ambil semua proposal
            $proposals = Proposal::paginate(10);
            $allProposals = Proposal::all();
        } elseif ($admin === 'bp') {
            // Jika BP, hanya ambil proposal yang memiliki catatan dari Manager ke BP
            $proposals = Proposal::whereHas('catatan', function ($query) {
                $query->where('role_pengirim', 'Manager')
                      ->where('role_dituju', 'BP');
            })->paginate(10);
            $allProposals = Proposal::whereHas('catatan', function ($query) {
                $query->where('role_pengirim', 'Manager')
                      ->where('role_dituju', 'BP');
            });
        } else {
            // Jika role tidak dikenali, tampilkan kosong atau handle sesuai kebutuhan
            $proposals = collect(); // Koleksi kosong
        }
    
        return view('admin.indexproposal', compact('proposals', 'allProposals'));
    }

    public function indexlpj(){
        $lpjs = LPJ::with('proposal')->paginate(10);
        $allLPJ = LPJ::all();

        return view('admin.indexlpj', compact('lpjs', 'allLPJ'));
    }

    public function indexadmins(){
        $admins = Admin::all();

        return view('admin.bp.managementuserbp', compact('admins'));
    }

    //SHOW DETAIL UNTUK ADMIN
    public function showproposal($id)
    {
        $proposal = Proposal::with('mitra')->findOrFail($id);
        return view('admin.proposaldetail', compact('proposal'));
    }

    public function showlpj($id)
    {
        $lpj = LPJ::with(['proposal.mitra'])->findOrFail($id);
        return view('admin.lpjdetail', compact('lpj'));
    }

    public function showmitra($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('admin.mitradetail', compact('mitra'));
    }

    public function proposalbp($id){
        $proposal = Proposal::with(['mitra', 'catatan'])->findOrFail($id);

        $catatanFOtoMitra = $proposal->catatan
        ->where('role_pengirim', 'Frontoffice')
        ->where('role_dituju', 'Mitra')
        ->first();

        // Ambil catatan dari Manager ke BP
        $catatanManagerToBP = $proposal->catatan
            ->where('role_pengirim', 'Manager')
            ->where('role_dituju', 'BP')
            ->first();

            // Ambil catatan dari Manager ke BP
        $catatanBPtoManager = $proposal->catatan
        ->where('role_pengirim', 'BP')
        ->where('role_dituju', 'Manager')
        ->first();

        return view('admin.bp.bpdetail', compact('proposal', 'catatanFOtoMitra', 'catatanManagerToBP', 'catatanBPtoManager'));
    }

    public function storeCatatanBP(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_proposal' => 'required|exists:proposals,id', // Pastikan id_proposal valid dan ada di tabel proposals
            'isi_catatan' => 'required|string',
        ]);

        // Simpan catatan baru ke database
        $catatan = Catatan::where([
            'id_proposal' => $request->id_proposal,
            'role_pengirim' => 'BP', // Sesuai role pengirim
            'role_dituju' => 'Manager' // Sesuai role dituju
        ])->first();
    
        if ($catatan) {
            // Jika catatan sudah ada, update isi_catatan
            $catatan->update([
                'isi_catatan' => $request->isi_catatan,
            ]);
        } else {
            // Jika belum ada, buat catatan baru
            Catatan::create([
                'id_proposal' => $request->id_proposal, // Ambil dari input hidden
                'isi_catatan' => $request->isi_catatan,
                'role_pengirim' => 'BP', // Sesuai role pengirim
                'role_dituju' => 'Manager', // Sesuai role dituju
                'status' => true, // Contoh: Set status default sebagai aktif
            ]);
        }

        return redirect()->back()->with('success', 'Catatan berhasil dikirim.');
    }

}
