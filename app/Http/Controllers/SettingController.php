<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Str;

class SettingController extends Controller
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
        $setting = Setting::first();
        return view('main.setting.index',[
            'setting'=>$setting,
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
        $setting = Setting::findOrFail($id);

        $rules = [
            'name' => 'required|max:225',
            'email' => 'nullable|max:225',
            'number' => 'nullable|max:11|min:11',
            'title' => 'required|max:225',
            'footer' => 'nullable|max:225',
            'logo'=>'nullable|max:1024',
            'favicon'=>'nullable|max:1024',
        ];

        $validatedData = $request->validate($rules);

        // white_logo

        if ($request->logo) {
            $imagePath = public_path('uploads/setting/' . $setting->logo);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->logo;
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/setting'), $fileName);
            $validatedData['logo'] = $fileName;
        }

        // favicon
        if ($request->favicon) {
            $imagePath = public_path('uploads/setting/' . $setting->favicon);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->favicon;
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/setting'), $fileName);
            $validatedData['favicon'] = $fileName;
        }

        $setting->update($validatedData);

        if ($setting) {
            return back()->with('success', 'Setting updated successfully.');
        } else {
            return back()->with('error', 'Failed to update Setting.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
