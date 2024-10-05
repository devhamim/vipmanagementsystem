<?php

namespace App\Http\Controllers;

use App\Models\PaymentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 0) {
            $paymentdatas = PaymentData::where('added_by', $user->id)->get();
        } else {
            $paymentdatas = PaymentData::all();
        }
        return view('main.paymentdata.index',[
            'paymentdatas'=>$paymentdatas,
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
            'due' => 'nullable',
            'total' => 'nullable',
            'note' => ['nullable', 'string',],
        ];

        $validateData = $request->validate($rules);

        $validateData['added_by'] = Auth::user()->id;

        PaymentData::create($validateData);

        alert('success','created successfully.', 'success');
        return back()->with('success', 'created successfully.');
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
            'due' => 'nullable',
            'total' => 'nullable',
            'note' => ['nullable', 'string',],
        ];

        $validateData = $request->validate($rules);

        $PaymentData->update($validateData);


        alert('success','Update successfully.', 'success');
        return back()->with('success', 'Update successfully.');
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
}
