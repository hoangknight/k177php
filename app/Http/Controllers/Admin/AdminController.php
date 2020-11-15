<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function index(){
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        for($i = 1; $i <= $currentMonth; $i++){
            $dataChart['Tháng '. $i] = Order::where('state',1)
                                        ->whereMonth('updated_at',$i)
                                        ->whereYear('updated_at',$currentYear)
                                        ->sum('total');
        }
        $data['chartData'] = $dataChart;
        $data['totalOrders'] = Order::where('state',0)->count();
        // dd($data);
    	return view('backend.index', $data);
    }

    public function logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }
}
