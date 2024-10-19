<?php

namespace App\Http\Controllers;

use App\Models\PaymentData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeHomeView extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //employe_home_view
    function employe_home_view(Request $request ,$id){
        $request->session()->put('employe_id', $id);

        $employ_id = $id;

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (empty($startDate) && empty($endDate)) {
            // $startDate = '';
            // $endDate = '';
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }
        else {
            $endDate = Carbon::parse($endDate)->addDay();
            $endDate = $endDate->format('Y-m-d');
        }

        $paymentdata_count = PaymentData::where('added_by', $id)->whereBetween('created_at', [$startDate, $endDate])->count();
            $paymentdatas = PaymentData::where('added_by', $id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();

        $total_pay = 0;
        $total_due = 0;
        $total = 0;
        $total_comition = 0;
        foreach($paymentdatas as $payment){
            $total_pay += $payment->pay;
            $total_due += $payment->due;
            $total += $payment->total;
        }
        if ($total_pay >= 100000) {
            $full_lakhs = floor($total_pay / 100000);

            $total_comition = $full_lakhs * 10000;
        }


        // previous month
        $prevMonthStart = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $prevMonthEnd = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

        $prevPaymentdatas = PaymentData::where('added_by', $id)->whereBetween('created_at', [$prevMonthStart, $prevMonthEnd])->get();

        $prev_total_pay = 0;
        foreach ($prevPaymentdatas as $payment) {
            $prev_total_pay += $payment->pay;
        }

        // pay
        $growth_percentage_pay = 0;
        if ($prev_total_pay > 0) {
            $growth_percentage_pay = (($total_pay - $prev_total_pay) / $prev_total_pay) * 100;
        } else {
            $growth_percentage_pay = 100;
        }
        $growth_type_pay = $growth_percentage_pay >= 0 ? 'up' : 'down';

        return view('main.employpaymentdataview.index',[
            'paymentdatas'=>$paymentdatas,
            'defaultStartDate' => $startDate,
            'defaultEndDate' => $endDate,
            'paymentdata_count' => $paymentdata_count,
            'total_pay' => $total_pay,
            'total_due' => $total_due,
            'total' => $total,
            'total_comition' => $total_comition,
            'growth_type_pay' => $growth_type_pay,
            'growth_percentage_pay' => $growth_percentage_pay,
            'employ_id' => $employ_id,
        ]);

    }

    // return_home
    function return_home(Request $request){

        $request->session()->forget('user_id');

        return redirect()->route('employe.index');

    }
}
