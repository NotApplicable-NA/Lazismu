<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getChartData()
{
    return response()->json([
        'monthlyProposals' => [20, 40, 30, 90, 60, 80, 30], // Data Proposal Bulanan
        'approvedBudgets' => [14000000, 59070000, 42550000, 58650000, 44500000, 99700000], // Anggaran
        'pillarData' => [
            'labels' => ['Pendidikan', 'Kemanusiaan', 'Dakwah', 'Ekonomi', 'Kesehatan', 'Lingkungan'],
            'values' => [87.65, 99.67, 88.37, 49.9, 60.84, 88.36]
        ]
    ]);
}
}
