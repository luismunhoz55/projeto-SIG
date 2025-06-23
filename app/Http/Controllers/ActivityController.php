<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with('positions')->latest()->get();

        return Inertia::render("activity/index", [
            'activities' => $activities
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
        $activity = Activity::create();

        return response()->json($activity);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return Inertia::render("activity/show", [
            'activity' => $activity->load('positions')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $positions = $request->positions;

        $start = $positions[0]['registered_at'];
        $end = end($positions)['registered_at'];

        $duration = (int) Carbon::parse($start)->diffInSeconds(Carbon::parse($end));

        $activity->update(['start' => $start, 'end' => $end, 'duration' => $duration]);

        foreach ($request->positions as $position) {
            $activity->positions()->create($position);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
