<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\InsuranceModel;
use App\Models\Order;
use App\Models\SiteVisit;
use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shetabit\Visitor\Models\Visit;


class DashboardController extends Controller
{
    public function index()
    {

        $get_site_visit = $this->get_site_visit();
        $val=$get_site_visit['val'];
        $date=$get_site_visit['date'];
        $today_visit_count=$get_site_visit['today_visit_count'];
        $yesterdayVisits=$get_site_visit['yesterdayVisits'];
        $this_month_Visits=$get_site_visit['this_month_Visits'];
        $total_visit=$get_site_visit['total_visit'];




        //Comments
        $comments = Comment::latest()->get()->count();


        return view('admin.dashboard.index', compact(
            'comments',
            'date',
            'val',
            'today_visit_count',
            'yesterdayVisits',
            'this_month_Visits',
            'total_visit',
        ));
    }


    public function today_visits()
    {
        return SiteVisit::where('date', '>', Carbon::yesterday())->count();
    }

    public function yesterday_visits($time)
    {
        $visit = InsuranceModel::where('date', '=', $time)->first();
        if ($visit) {
            $total_visits = $visit->total_visits;
        } else {
            $total_visits = 0;
        }
        return $total_visits;
    }

    public function this_month_visits($time)
    {
        $visit = InsuranceModel::where('date', '>=', $time)->get();
        if ($visit) {
            $total_visits = 0;
            foreach ($visit as $item) {
                $total_visits += $item->total_visits;
            }
        } else {
            $total_visits = 0;
        }
        return $total_visits;
    }

    public function total_visits()
    {
        $visit = InsuranceModel::all();
        if ($visit) {
            $total_visits = 0;
            foreach ($visit as $item) {
                $total_visits += $item->total_visits;
            }
        } else {
            $total_visits = 0;
        }
        return $total_visits;
    }

    public function getVisitTime($number)
    {
        $day_ago = -$number;
        $time = Carbon::now()->copy()->addDay($day_ago);
        $date = \verta($time)->format('%d %B');
        $visit = InsuranceModel::where('date', '=', $time->format('Y-m-d'))->first();
        if ($visit) {
            $total_visits = $visit->total_visits;
        } else {
            $total_visits = 0;
        }

        return [
            'date' => $date,
            'today_visit_count' => $total_visits
        ];
    }

    public function get_site_visit()
    {
        $date = [];
        $val = [];
        //get insurance for chartJs
        $day_ago = 10;
        for ($i = 2; $i < $day_ago;$i++) {
            $visit_insurance=$this->getVisitTime($i);
            $date_visit = $visit_insurance['date'];
            $today_visit_count_visit = $visit_insurance['today_visit_count'];
            array_push($date, $date_visit);
            array_push($val, $today_visit_count_visit);
        }
//visit insurance
        $yesterdayVisits = $this->yesterday_visits(Carbon::yesterday());
        //today visit
        $today_visit_count = $this->today_visits();
        $date=array_reverse($date);
        $val=array_reverse($val);
        array_push($date, 'دیروز');
        array_push($val, $yesterdayVisits);
        array_push($date, 'امروز');
        array_push($val, $today_visit_count);

        //
        $startMonth = convertShamsiToGregorianDate((new Verta())->startMonth());
        $this_month_Visits = $this->this_month_visits($startMonth);
        $total_visit = $this->total_visits();
        $date = json_encode($date, JSON_NUMERIC_CHECK);
        $val = json_encode($val, JSON_NUMERIC_CHECK);

        return [
            'date'=>$date,
            'val'=>$val,
            'today_visit_count'=>$today_visit_count,
            'yesterdayVisits'=>$yesterdayVisits,
            'this_month_Visits'=>$this_month_Visits,
            'total_visit'=>$total_visit
        ];
    }
}
