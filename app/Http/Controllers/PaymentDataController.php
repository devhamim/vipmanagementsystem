<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PaymentData;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Notifications\PaymentAddedNotification;

class PaymentDataController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

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

        $user = auth()->user();

        if ($user->role == 1) {
            $paymentdata_count = PaymentData::whereBetween('created_at', [$startDate, $endDate])->count();
            $paymentdatas = PaymentData::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
        } else {
            $paymentdata_count = PaymentData::where('added_by', $user->id)->whereBetween('created_at', [$startDate, $endDate])->count();
            $paymentdatas = PaymentData::where('added_by', $user->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
        }

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

        if ($user->role == 1) {
            $prevPaymentdatas = PaymentData::whereBetween('created_at', [$prevMonthStart, $prevMonthEnd])->get();
        } else {
            $prevPaymentdatas = PaymentData::where('added_by', $user->id)->whereBetween('created_at', [$prevMonthStart, $prevMonthEnd])->get();
        }
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

        return view('main.paymentdata.index',[
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
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.paymentdata.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'number' => ['nullable', 'string'],
            'online_offline' => 'nullable',
            'payment_method' => ['nullable', 'string'],
            'pay' => 'nullable',
            'total' => 'nullable',
            'note' => ['nullable', 'string',],
        ];

        $validateData = $request->validate($rules);

        $validateData['added_by'] = Auth::user()->id;
        $validateData['due'] = $request->total-$request->pay;
        $paymentData = PaymentData::create($validateData);

    Auth::user()->notify(new PaymentAddedNotification(
        Auth::user()->name,
        $paymentData->pay,
        $paymentData->name,
        $paymentData->id,
        false
    ));

    $adminsAndModerators = User::whereIn('role', [1, 2])->get();

    foreach ($adminsAndModerators as $admin) {
        if($admin->token){
            $admin->notify(new PaymentAddedNotification(
                Auth::user()->name,
                $paymentData->pay,
                $paymentData->name,
                $paymentData->id,
                false
            ));
        }

    }


        $total_pay = PaymentData::where('added_by', Auth::user()->id)
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->sum('pay');

    // Calculate commission
    $total_comition = 0;
    if ($total_pay >= 100000) {
        $full_lakhs = floor($total_pay / 100000);
        $total_comition = $full_lakhs * 10000;
    }

    $employee = Employee::where('user_id', Auth::user()->id)->first();

    if ($employee) {

        $employee->commission = $total_comition;
        $employee->save();
    } else {
        \Log::error('Employee not found for user ID: ' . Auth::user()->id);
    }

        alert('success','created successfully.', 'success');
        return redirect()->route('paymentdata.index')->with('success', 'created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paymentdata = PaymentData::find($id);
        return view('main.paymentdata.edit',[
            'paymentdata'=>$paymentdata,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $PaymentData = PaymentData::find($id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'number' => ['nullable', 'string'],
            'online_offline' => 'nullable',
            'payment_method' => ['nullable', 'string'],
            'pay' => 'nullable',
            'total' => 'nullable',
            'status' => 'nullable',
            'verify_by' => 'nullable',
            'note' => ['nullable', 'string',],
        ];

        $validateData = $request->validate($rules);

        $validateData['due'] = $request->total-$request->pay;
        $PaymentData->update($validateData);

        $userName = auth()->user()->name;

        // Notify all admins and moderators
        $adminsAndModerators = User::whereIn('role', [1, 2])->get();

        foreach ($adminsAndModerators as $admin) {
            $admin->notify(new PaymentAddedNotification(
                $userName,
                $PaymentData->pay,
                $PaymentData->name,
                $PaymentData->id,
                true 
            ));
        }

        $total_pay = PaymentData::where('added_by', Auth::user()->id)
        ->whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->sum('pay');

    // Calculate commission
    $total_comition = 0;
    if ($total_pay >= 100000) {
        $full_lakhs = floor($total_pay / 100000);
        $total_comition = $full_lakhs * 10000;
    }

    $employee = Employee::where('user_id', Auth::user()->id)->first();

    if ($employee) {

        $employee->commission = $total_comition;
        $employee->save();
    } else {
        \Log::error('Employee not found for user ID: ' . Auth::user()->id);
    }

        alert('success','Update successfully.', 'success');
        return redirect()->route('paymentdata.index')->with('success', 'Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PaymentData::find($id)->delete();
        // toast('Warning Toast','warning');
        alert()->warning('Delete','Delete successfully.');
        return back()->with('Warning', 'Delete successfully.');
    }

    public function paymentdata_search(Request $request)
{
    $query = $request->input('query');

    // Fetch payment data matching the query
    $paymentdatas = PaymentData::where('name', 'LIKE', "%{$query}%")
        ->orWhere('email', 'LIKE', "%{$query}%")
        ->orWhere('added_by', 'LIKE', "%{$query}%")
        ->orWhere('online_offline', 'LIKE', "%{$query}%")
        ->orWhere('payment_method', 'LIKE', "%{$query}%")
        ->orWhere('note', 'LIKE', "%{$query}%")
        ->paginate(10);

    if ($request->ajax()) {
        return response()->json([
            'paymentdatas' => view('main.paymentdata.partial_list', compact('paymentdatas'))->render(),
            'pagination' => $paymentdatas->links()->render(),
        ]);
    }

    return view('main.paymentdata.index', compact('paymentdatas'));
}


}
