<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Str;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
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
        $users = User::all();
        return view('main.users.index',[
            'users'=>$users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'number' => ['nullable', 'string', 'min:11', 'unique:users'],
            'image' => ['nullable', 'max:2048'],
            'role' => 'required',
            'status' => 'required',
        ];

        $validateData = $request->validate($rules);

        $validateData['user_id'] = Str::slug($request->name) . '-' . random_int(10000, 99999);
        $validateData['password'] = Hash::make($validateData['password']);
        $validateData['temp_password'] = $request->password;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/user'), $fileName);
            $validateData['image'] = $fileName;
        }

        User::create($validateData);

        alert('success','User created successfully.', 'success');
        return back()->with('success', 'User created successfully.');
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
        $users = User::find($id);
        return view('main.users.edit',[
            'users'=>$users,
        ]);
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
            'number' => ['nullable', 'string', 'min:11',],
            'image' => ['nullable', 'max:2048'],
            'role' => 'required',
            'status' => 'required',
        ];

        $validateData = $request->validate($rules);

        if($request->password){
            $validateData['password'] = Hash::make($validateData['password']);
            $validateData['temp_password'] = $request->password;
        }

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
        // toast('Warning Toast','warning');
        // Alert::alert('Title', 'created successfully', 'success');
        alert('success','User created successfully.', 'success');
        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        // toast('Warning Toast','warning');
        alert()->warning('Delete','Delete successfully.');
        return back()->with('Warning', 'Delete successfully.');
    }
}
