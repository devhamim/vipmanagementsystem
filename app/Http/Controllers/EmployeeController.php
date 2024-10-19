<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Str;

class EmployeeController extends Controller
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
        $employes = Employee::all();

        return view('main.employ.index',[
            'employes'=>$employes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.employ.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'min:11', 'unique:users'],
            'image' => ['nullable', 'max:2048'],
            'salary' => 'required',
            'status' => 'required',
        ];

        $validateData = $request->validate($rules);

        $validateData['user_id'] = Str::slug($request->name) . '-' . random_int(10000, 99999);
        $validateData['havetopay'] = $request->salary;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/employe'), $fileName);
            $validateData['image'] = $fileName;
        }

        Employee::create($validateData);

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
        $employes = Employee::find($id);
        return view('main.employ.edit',[
            'employes'=>$employes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employes = Employee::find($id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'number' => ['nullable', 'string', 'min:11', 'unique:users'],
            'image' => ['nullable', 'max:2048'],
            'salary' => 'required',
            'status' => 'required',
        ];

        $validateData = $request->validate($rules);

        if ($request->hasFile('image')) {
            $imagePath = public_path('uploads/employe/' . $employes->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/employe'), $fileName);
            $validateData['image'] = $fileName;
        }

        $employes->update($validateData);
        alert('success','Created successfully.', 'success');
        return redirect()->route('employe.index')->with('success', 'Created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
