<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $name = Auth::user()->name;

        $upcomingActivities = Activity::where('user_id', $userId)
                            ->where('start_date', '>=', now())
                            ->orderBy('start_date', 'asc')
                            ->take(3)
                            ->get();

        $ongoingActivities = Activity::where('user_id', $userId)
                            ->where('start_date', '<', now())
                            ->where('end_date', '>=', now())
                            ->orderBy('end_date', 'asc')
                            ->take(3)
                            ->get();

        $upcomingCount = Activity::where('user_id', $userId)->where('start_date', '>=', now())->count();

        $ongoingCount = Activity::where('user_id', $userId)
                            ->where('start_date', '<', now())
                            ->where('end_date', '>=', now())
                            ->count();

        $completedCount = Activity::where('user_id', $userId)->where('end_date', '<', now())->count();

        return view('dashboard', [
            'name' => $name,
            'upcomingActivities' => $upcomingActivities,
            'ongoingActivities' => $ongoingActivities,
            'upcomingCount' => $upcomingCount,
            'ongoingCount' => $ongoingCount,
            'completedCount' => $completedCount,
        ]);
    }

    public function displayActivities()
    {
        $userId = Auth::id();

        $activities = Activity::where('user_id', $userId)->get();

        return view('activities', ['activities' => $activities]);
    }

    public function addActivity(Request $request)
    {
        $userId = Auth::id();

        $title = $request->input('title');
        $description = $request->input('description');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $category = $request->input('category');
        $status = $request->input('status');

        $entity = Activity::create([
            'title' => $title,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'category' => $category,
            'status' => $status,
            'user_id' => $userId,
        ]);

        $entity->save();

        return view('add');
    }

    public function viewActivity($id)
    {
        // $id will contain the value from the URL
        $activity = Activity::findOrFail($id);
        return view('activity', ['activity' => $activity]);
    }

    public function editActivity(Request $request, $id)
    {
        $activity = Activity::find($id);

        if ($activity) {
            $activity->status = $request->input('status');
            $activity->save();
            return redirect()->back()->with('success', 'Activity status updated successfully.');
        }

        return redirect()->back()->with('error', 'Activity not found.');
    }

    public function deleteActivity($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('activities')->with('success', 'Activity deleted.');
    }
}
