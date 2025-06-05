<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
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

    public function displayActivities()
    {
        $activities = Activity::all();
        return view('activities', ['activities' => $activities]);
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

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();

            // Create a cookie with user ID that lasts for 1 hour
            $cookie = cookie('user_id', $user->id, 60); // 60 minutes = 1 hour

            return redirect()->intended('/')->withCookie($cookie);
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
