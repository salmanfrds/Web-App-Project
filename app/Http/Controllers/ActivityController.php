<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('mainpage', ['john' => $activities]);
    }

    public function addActivity(Request $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $category = $request->input('category');
        $status = $request->input('status');
        $user_id = $request->input('user_id');

        $entity = Activity::create([
            'title' => $title,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'category' => $category,
            'status' => $status,
            'user_id' => $user_id,
        ]);

        $entity->save();

        return view('add');
    }

    public function displayDashboard()
    {
        $upcomingActivities = Activity::where('start_date', '>=', now())
                            ->orderBy('start_date', 'asc')
                            ->take(3)
                            ->get();

        $ongoingActivities = Activity::where('start_date', '<', now())
                            ->where('end_date', '>=', now())
                            ->orderBy('end_date', 'asc')
                            ->take(3)
                            ->get();

        $upcomingCount = Activity::where('start_date', '>=', now())->count();

        $ongoingCount = Activity::where('start_date', '<', now())
                ->where('end_date', '>=', now())
                ->count();

        $completedCount = Activity::where('end_date', '<', now())->count();

        return view('dashboard', [
            'upcomingActivities' => $upcomingActivities,
            'ongoingActivities' => $ongoingActivities,
            'upcomingCount' => $upcomingCount,
            'ongoingCount' => $ongoingCount,
            'completedCount' => $completedCount,
        ]);
    }
}
