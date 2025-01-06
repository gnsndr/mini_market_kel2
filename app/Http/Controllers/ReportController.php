<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $branchId = $request->branch_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $reports = Branch::with(['transactions' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }])->findOrFail($branchId);

        return view('reports.index', compact('reports'));
    }
}
