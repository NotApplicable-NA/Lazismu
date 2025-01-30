<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Proposal;
use App\Models\LPJ;
use App\Models\Catatan;
use App\Models\Admin;
use App\Models\Asesmen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        } elseif ($admin === 'frontoffice') {
            // Ambil semua proposal dengan status "Masuk"
            $proposals = Proposal::where('status', 'Masuk')->paginate(10);
            
            // Ambil semua proposal dengan status "Masuk" tanpa pagination (jika diperlukan)
            $allProposals = Proposal::where('status', 'Masuk')->get();
        } elseif ($admin === 'manager') {
            // Jika BP, hanya ambil proposal yang memiliki catatan dari Manager ke BP
            $proposals = Proposal::whereHas('catatan', function ($query) {
                $query->where('role_pengirim', 'Frontoffice')
                      ->where('role_dituju', 'Manager');
            })->paginate(10);
            $allProposals = Proposal::whereHas('catatan', function ($query) {
                $query->where('role_pengirim', 'Frontoffice')
                      ->where('role_dituju', 'Manager');
            });
        } elseif ($admin === 'program') {
            // Jika BP, hanya ambil proposal yang memiliki catatan dari Manager ke BP
            $proposals = Proposal::whereHas('catatan', function ($query) {
                $query->where('role_pengirim', 'Manager')
                      ->where('role_dituju', 'Program');
            })->paginate(10);
            $allProposals = Proposal::whereHas('catatan', function ($query) {
                $query->where('role_pengirim', 'Manager')
                      ->where('role_dituju', 'Program');
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

    //FUNGSI BP BUAT DETAIL PROPOSAL DAN USER MANAGEMENT

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

    //FUNGSI FO BUAT CATATAN DAN PROPOSAL

    public function storeCatatanFO(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_proposal' => 'required|exists:proposals,id', // Pastikan ID proposal valid
            'isi_catatan' => 'required|string|max:255',
            'kategoriPengajuan' => 'required|string',
        ]);

        // Ambil proposal berdasarkan ID
        $proposal = Proposal::findOrFail($request->input('id_proposal'));

        // Menentukan nilai role_dituju berdasarkan tombol yang diklik
        $roleDituju = $request->input('action') === 'kirim' ? 'Mitra' : 'Manager';

        // Update kategori_pengajuan pada tabel proposal
        $proposal->kategori_pengajuan = $request->input('kategoriPengajuan');
        $proposal->status = "Proses";
        $proposal->save();

        // **Periksa apakah sudah ada catatan ke Manager dan Mitra**
        $catatanManager = Catatan::where('id_proposal', $proposal->id)
            ->where('role_pengirim', 'Frontoffice')
            ->where('role_dituju', 'Manager')
            ->first();

        $catatanMitra = Catatan::where('id_proposal', $proposal->id)
            ->where('role_pengirim', 'Frontoffice')
            ->where('role_dituju', 'Mitra')
            ->first();

        if ($roleDituju === 'Manager') {
            // **Update atau buat catatan ke Mitra**
            if ($catatanMitra) {
                $catatanMitra->isi_catatan = $request->input('isi_catatan');
                $catatanMitra->save();
            } else {
                Catatan::create([
                    'id_proposal' => $proposal->id,
                    'isi_catatan' => $request->input('isi_catatan'),
                    'role_pengirim' => 'Frontoffice',
                    'role_dituju' => 'Mitra',
                ]);
            }

            // **Update atau buat catatan ke Manager**
            if ($catatanManager) {
                $catatanManager->isi_catatan = $request->input('isi_catatan');
                $catatanManager->save();
            } else {
                Catatan::create([
                    'id_proposal' => $proposal->id,
                    'isi_catatan' => $request->input('isi_catatan'),
                    'role_pengirim' => 'Frontoffice',
                    'role_dituju' => 'Manager',
                ]);
            }
        } else {
            // **Jika role_dituju adalah Mitra, update atau buat catatan ke Mitra**
            if ($catatanMitra) {
                $catatanMitra->isi_catatan = $request->input('isi_catatan');
                $catatanMitra->save();
            } else {
                Catatan::create([
                    'id_proposal' => $proposal->id,
                    'isi_catatan' => $request->input('isi_catatan'),
                    'role_pengirim' => 'Frontoffice',
                    'role_dituju' => 'Mitra',
                ]);
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }




    public function proposalfo($id){
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

        return view('admin.frontoffice.frontofficedetail', compact('proposal', 'catatanFOtoMitra', 'catatanManagerToBP', 'catatanBPtoManager'));
    }

    //FUNGSI KEUANGAN BUAT PROPOSAL

    //FUNGSI MANAGER BUAT PROPOSAL DETAIL

    public function proposalmanager($id){
        $proposal = Proposal::with(['mitra', 'catatan'])->findOrFail($id);

        $catatanFOtoManager = $proposal->catatan
        ->where('role_pengirim', 'Frontoffice')
        ->where('role_dituju', 'Manager')
        ->first();

        $catatanManagerToBP = Catatan::where('id_proposal', $id)
                             ->where('role_pengirim', 'Manager')
                             ->where('role_dituju', 'BP')
                             ->first();

        $catatanManagerToProgram = Catatan::where('id_proposal', $id)
                                        ->where('role_pengirim', 'Manager')
                                        ->where('role_dituju', 'Program')
                                        ->first();

        //CATATAN UNTUK MENGAKTIFKAN TOMBOL ACC DAN TOLAK JIKA DANA LEBIH DARI 5 JT
        $catatanBPtoManager = Catatan::where('id_proposal', $id)
                                        ->where('role_pengirim', 'BP')
                                        ->where('role_dituju', 'Manager')
                                        ->first();

        $catatanProgramToManager = Catatan::where('id_proposal', $id)
                                        ->where('role_pengirim', 'BP')
                                        ->where('role_dituju', 'Manager')
                                        ->first();

        return view('admin.manager.managerdetail', compact('proposal', 'catatanFOtoManager', 'catatanManagerToBP', 'catatanManagerToProgram', 'catatanBPtoManager', 'catatanProgramToManager'));
    }

    public function storeDisposisi(Request $request)
    {
        $request->validate([
            'role_dituju' => 'required|in:Program,BP',
            'catatan' => 'required|string',
            'id_proposal' => 'required|integer|exists:proposals,id',
            'file_assessment' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Cek apakah sudah ada catatan dengan id_proposal, role_dituju, dan role_pengirim 'Manager'
        $disposisi = Catatan::where('id_proposal', $request->id_proposal)
        ->where('role_dituju', $request->role_dituju)
        ->where('role_pengirim', 'Manager')
        ->first();

        if ($disposisi) {
            // Jika sudah ada, lakukan update isi_catatan
            $disposisi->isi_catatan = $request->catatan;
    
            // Jika ada file baru diunggah, update file
            if ($request->hasFile('file_assessment')) {
                $file = $request->file('file_assessment');
                $filePath = $file->store('uploads', 'public'); // Simpan di storage/app/public/uploads
                $disposisi->file_path = $filePath; // Simpan path file di database
            }
    
            $disposisi->save();
            $message = "Catatan berhasil diperbarui!";
        } else {
            // Jika belum ada, buat catatan baru
            $disposisi = new Catatan();
            $disposisi->id_proposal = $request->id_proposal;
            $disposisi->isi_catatan = $request->catatan;
            $disposisi->role_pengirim = "Manager";
            $disposisi->role_dituju = $request->role_dituju;
            $disposisi->status = 0; // Default Status
    
            // Simpan file jika ada
            if ($request->hasFile('file_assessment')) {
                $file = $request->file('file_assessment');
                $filePath = $file->store('uploads', 'public'); // Simpan di storage/app/public/uploads
                $disposisi->file_path = $filePath; // Simpan path file di database
            }
    
            $disposisi->save();
            $message = "Catatan baru berhasil ditambahkan!";
        }
    
        return redirect()->back()->with('success', $message);
    }

    public function storePengajuanManager(Request $request){
        // Validasi data input

        $validator = Validator::make($request->all(), [
            'id_proposal' => 'required|integer|exists:proposals,id',
            'pilar_program' => 'required|string',
            'sasaran_ashnaf' => 'required|string',
            'jumlah_laki' => 'required|integer|min:0',
            'jumlah_perempuan' => 'required|integer|min:0',
            'sumber_pendanaan' => 'required|string',
            'produktif_or_konsumtif' => 'required|string|in:konsumtif,produktif',
            'jumlah_pendanaan' => 'required|string',
            'pencairan_dana' => 'required|string',
            'catatan_manager' => 'required|string',
        ]);

        $id = $request->id_proposal;
        $jumlah_total = $request->jumlah_laki + $request->jumlah_perempuan;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Cari proposal berdasarkan ID
            $proposal = Proposal::findOrFail($id);

            $proposal->pilar = $request->pilar_program;
            $proposal->sasaran_ashnaf = $request->sasaran_ashnaf;
            $proposal->penerima_laki = $request->jumlah_laki ?? 0;
            $proposal->penerima_perempuan = $request->jumlah_perempuan ?? 0;
            $proposal->penerima_total = $jumlah_total;
            $proposal->sumber_pendanaan = $request->sumber_pendanaan;
            $proposal->produktif_or_konsumtif = $request->produktif_or_konsumtif;
            $proposal->anggaran_disetujui = preg_replace('/[^0-9]/', '', $request->jumlah_pendanaan);
            $proposal->pencairan_via = $request->pencairan_dana;
            $proposal->status = "Diterima";
            // $proposal->catatan_manager = $request->catatan_manager;
            // dd($proposal->toArray());

            $proposal->save();

            return redirect()->route('admin.indexproposal', ['admin' => "manager"])->with('success', 'Pengajuan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function proposalprogram($id){
        $proposal = Proposal::with(['mitra', 'catatan'])->findOrFail($id);

        $catatanManagerToProgram = $proposal->catatan
        ->where('role_pengirim', 'Manager')
        ->where('role_dituju', 'Program')
        ->first();

        // Cek apakah asesmen sudah ada untuk proposal ini
        $asesmen = Asesmen::where('id_proposal', $id)->first();

        // Ambil daftar admin dengan role "Program"
        $adminsProgram = Admin::where('role', 'Program')->get(); 

        return view('admin.program.programdetail', compact('proposal', 'catatanManagerToProgram', 'asesmen', 'adminsProgram'));
    }

    public function storePemohon(Request $request)
    {
        // Validasi input
        $request->validate([
            'program_pemohon' => 'required|string|max:255',
        ],
        [
            'program_pemohon.required' => 'Silakan pilih pemohon sebelum menyimpan.',
        ]);

        try {
            // Cari proposal berdasarkan ID yang dikirim (pastikan ada hidden input 'id_proposal' dalam form)
            $proposal = Proposal::findOrFail($request->id_proposal);
            
            // Simpan data program_pemohon
            $proposal->program_pemohon = $request->program_pemohon;
            $proposal->save();

            return redirect()->back()->with('success', 'Pemohon berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
