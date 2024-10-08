<?php

namespace App\Http\Controllers;

use App\Models\PaymentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

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

        if ($user->role == 1) {
            $paymentdatas = PaymentData::paginate(30);
        } else {
            $paymentdatas = PaymentData::where('added_by', $user->id)->paginate(30);
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
            'total' => 'nullable',
            'note' => ['nullable', 'string',],
        ];

        $validateData = $request->validate($rules);

        $validateData['added_by'] = Auth::user()->id;
        $validateData['due'] = $request->total-$request->pay;
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

    public function search(Request $request)
{
    \Log::info('Search query: ' . $request->input('query')); // Log the search query
    return response()->json(['message' => 'Search function hit!']);
    $query = $request->input('query');

    // Search for payment data
    $paymentdatas = PaymentData::where('name', 'LIKE', "%{$query}%")
        ->orWhere('added_by', 'LIKE', "%{$query}%")
        ->paginate(30); // Use pagination as needed

    // If it’s an AJAX request
    if ($request->ajax()) {
        return response()->json([
            'paymentdatas' => view('main.paymentdata.partial_list', ['paymentdatas' => $paymentdatas])->render(),
            'pagination' => $paymentdatas->links()->render(),
        ]);
    }

    // For non-AJAX requests, return the view with results
    return 'sssss';
    return view('main.paymentdata.index', compact('paymentdatas'));

}


}
