<?php

namespace App\Http\Controllers;

use App\Models\DailyCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyCostController extends Controller
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
            $dailycosts = DailyCost::paginate(30);
        } else {
            $dailycosts = DailyCost::where('added_by', $user->id)->paginate(2);
        }
        return view('main.dailycost.index',[
            'dailycosts'=>$dailycosts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.dailycost.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'forwho' => ['nullable', 'string', 'max:255'],
            'pay' => 'nullable',
            'total' => 'nullable',
            'note' => ['nullable', 'string',],
        ];

        $validateData = $request->validate($rules);

        $validateData['added_by'] = Auth::user()->id;
        $validateData['due'] = $request->total-$request->pay;
        DailyCost::create($validateData);

        alert('success','created successfully.', 'success');
        return redirect()->route('dailycost.index')->with('success', 'created successfully.');
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
        $dailycosts = DailyCost::find($id);
        return view('main.dailycost.edit',[
            'dailycosts'=>$dailycosts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dailycosts = DailyCost::find($id);
        $rules = [
           'name' => ['required', 'string', 'max:255'],
            'forwho' => ['nullable', 'string', 'max:255'],
            'pay' => 'nullable',
            'total' => 'nullable',
            'note' => ['nullable', 'string',],
        ];

        $validateData = $request->validate($rules);
        // $validateData['due'] = $request->total-$request->pay;

        $dailycosts->update($validateData);


        alert('success','Update successfully.', 'success');
        return redirect()->route('dailycost.index')->with('success', 'Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    $dailycosts = DailyCost::where('name', 'LIKE', "%{$query}%")
        ->orWhere('added_by', 'LIKE', "%{$query}%")
        ->paginate(30);

    if ($request->ajax()) {
        return response()->json([
            'dailycosts' => view('main.dailycost.partial_list', ['dailycosts' => $dailycosts])->render(),
            'pagination' => $dailycosts->links()->render(),
        ]);
    }

    return view('dailycost.index', compact('dailycosts'));
}


}
