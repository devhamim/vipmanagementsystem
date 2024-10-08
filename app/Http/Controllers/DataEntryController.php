<?php

namespace App\Http\Controllers;

use App\Models\DataEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class DataEntryController extends Controller
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
            $dataentrys = DataEntry::paginate(30);
        }
        elseif ($user->role == 2) {
            $dataentrys = DataEntry::where('added_by', $user->id)->paginate(30);
        }
        else {
            $dataentrys = DataEntry::where('added_by', $user->id)->paginate(30);
        }
        return view('main.dataentry.index',[
            'dataentrys'=>$dataentrys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.dataentry.add');
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
            'position' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'gender' => 'nullable',
            'age' => 'nullable',
            'lead' => 'nullable',
            'note' => ['nullable', 'string',],
            'image' => ['nullable', 'max:2048'],
            'status' => 'required',
        ];

        $validateData = $request->validate($rules);

        $validateData['added_by'] = Auth::user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/dataentry'), $fileName);
            $validateData['image'] = $fileName;
        }

        DataEntry::create($validateData);

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
        $dataentry = DataEntry::find($id);
        return view('main.dataentry.edit',[
            'dataentry'=>$dataentry,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataentry = DataEntry::find($id);
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'number' => ['nullable', 'string'],
            'position' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'gender' => 'nullable',
            'age' => 'nullable',
            'lead' => 'nullable',
            'note' => ['nullable', 'string',],
            'image' => ['nullable', 'max:2048'],
            'status' => 'required',
        ];

        $validateData = $request->validate($rules);

        if ($request->hasFile('image')) {
            $imagePath = public_path('uploads/dataentry/' . $dataentry->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/dataentry'), $fileName);
            $validateData['image'] = $fileName;
        }

        $dataentry->update($validateData);


        alert('success','Update successfully.', 'success');
        return back()->with('success', 'Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataentry = DataEntry::find($id);
        $imagePath = public_path('uploads/dataentry/' . $dataentry->image);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
        DataEntry::find($id)->delete();
        // toast('Warning Toast','warning');
        alert()->warning('Delete','Delete successfully.');
        return back()->with('Warning', 'Delete successfully.');
    }


    public function dataentrysearch(Request $request)
{
    $query = $request->input('query');

    $dataentrys = DataEntry::where('name', 'LIKE', "%{$query}%")
        ->orWhere('added_by', 'LIKE', "%{$query}%")
        ->paginate(30);

    if ($request->ajax()) {
        return response()->json([
            'dataentrys' => view('main.dataentry.partial_list', ['dataentrys' => $dataentrys])->render(),
            'pagination' => $dataentrys->links()->render(),
        ]);
    }

    return view('dataentry.index', compact('dataentrys'));
}

}
