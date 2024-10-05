<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
        $users = User::find(Auth::user()->id);
        return view('main.profile.index',[
            'users'=>$users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'number' => ['nullable', 'string', 'min:11',],
            'image' => ['nullable', 'max:2048'],
            'role' => 'required',
            'status' => 'required',
        ];

        $validateData = $request->validate($rules);

        $validateData['password'] = Hash::make($validateData['password']);
        $validateData['temp_password'] = $request->password;

        if ($request->hasFile('image')) {
            $imagePath = public_path('uploads/user/' . $users->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/user'), $fileName);
            $validateData['image'] = $fileName;
        }

        $users->update($validateData);

        alert('success','User created successfully.', 'success');
        return back()->with('success', 'User created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
