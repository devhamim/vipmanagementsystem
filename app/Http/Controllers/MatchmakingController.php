<?php

namespace App\Http\Controllers;

use App\Models\Matchmaking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchmakingController extends Controller
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
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }
        else {
            $endDate = Carbon::parse($endDate)->addDay();
            $endDate = $endDate->format('Y-m-d');
        }

        $user = auth()->user();

        if ($user->role == 1) {
            $matchmaking_count = Matchmaking::whereBetween('created_at', [$startDate, $endDate])->count();
            $matchmakings = Matchmaking::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
        } else {
            $matchmaking_count = Matchmaking::where('added_by', $user->id)->whereBetween('created_at', [$startDate, $endDate])->count();
            $matchmakings = Matchmaking::where('added_by', $user->id)->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
        }

        return view('main.matchmaking.index',[
            'matchmakings'=>$matchmakings,
            'defaultStartDate' => $startDate,
            'defaultEndDate' => $endDate,
            'matchmaking_count' => $matchmaking_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.matchmaking.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'groom_name' => ['required', 'string', 'max:255'],
            'groom_number' => ['nullable', 'string', 'max:255'],
            'bride_name' => ['nullable', 'string'],
            'bride_number' => ['nullable', 'string'],
            'meeting_date' => ['nullable', 'string'],
            'progress_report' => 'nullable',
            'marrage_date' => 'nullable',
            'note' => 'nullable',
        ];

        $validateData = $request->validate($rules);

        $validateData['added_by'] = Auth::user()->id;

        Matchmaking::create($validateData);

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
        $matchmaking = Matchmaking::find($id);
        return view('main.matchmaking.edit',[
            'matchmaking'=>$matchmaking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $matchmakings = Matchmaking::find($id);
        $rules = [
            'groom_name' => ['required', 'string', 'max:255'],
            'groom_number' => ['nullable', 'string', 'max:255'],
            'bride_name' => ['nullable', 'string'],
            'bride_number' => ['nullable', 'string'],
            'meeting_date' => ['nullable', 'string'],
            'progress_report' => 'nullable',
            'marrage_date' => 'nullable',
            'note' => 'nullable',
        ];

        $validateData = $request->validate($rules);

        $matchmakings->update($validateData);


        alert('success','Update successfully.', 'success');
        return redirect()->route('matchmaking.index')->with('success', 'Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Matchmaking::find($id)->delete();

        alert()->warning('Delete','Delete successfully.');
        return back()->with('Warning', 'Delete successfully.');
    }
}
