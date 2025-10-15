<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\SiteVisit;

class DashboardController extends Controller
{
    public function index()
    {
        //Comments
        $comments = Comment::latest()->get()->count();
        $chart = SiteVisit::chartData(30);

        return view('admin.dashboard.index', compact('chart'), [
            'todayVisits' => SiteVisit::today(),
            'yesterdayVisits' => SiteVisit::yesterday(),
            'monthVisits' => SiteVisit::thisMonth(),
            'totalVisits' => SiteVisit::total(),
            'chartDates' => $chart['dates'],
            'chartValues' => $chart['values'],
            'comments' => $comments,
        ]);
    }
}

