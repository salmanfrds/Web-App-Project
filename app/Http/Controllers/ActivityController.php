<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $name = Auth::user()->name;

        $upcomingActivities = Activity::where('user_id', $userId)
                            ->where('start_date', '>', now())
                            ->whereNotIn('status', ['completed', 'cancelled'])
                            ->orderBy('start_date', 'asc')
                            ->take(3)
                            ->get();

        $ongoingActivities = Activity::where('user_id', $userId)
                            ->where('start_date', '<=', now())
                            ->where('end_date', '>=', now())
                            ->whereNotIn('status', ['completed', 'cancelled'])
                            ->orderBy('end_date', 'asc')
                            ->take(3)
                            ->get();

        $upcomingCount = Activity::where('user_id', $userId)->where('status', 'active')->count();

        $activitiesCount = Activity::where('user_id', $userId)
                            ->where('status', '!=' , 'cancelled')
                            ->count();

        $completedCount = Activity::where('user_id', $userId)->where('status', 'completed')->count();

        return view('dashboard', [
            'name' => $name,
            'upcomingActivities' => $upcomingActivities,
            'ongoingActivities' => $ongoingActivities,
            'upcomingCount' => $upcomingCount,
            'activitiesCount' => $activitiesCount,
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
        $status = 'active';

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

        return redirect()->route('activities');
    }

    public function displayAdd(){
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

    //  Updated Image Upload Method
    public function uploadBanner(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $activity = Activity::where('activity_id', $id)->firstOrFail();

        // Delete old banner if exists
        if ($activity->banner_image && Storage::exists('public/' . $activity->banner_image)) {
            Storage::delete('public/' . $activity->banner_image);
        }

        $file = $request->file('banner_image');
        $path = $file->store('images', 'public');
        $path = 'storage/' . $path;
        $path = url($path);

        $activity->banner_image = $path;
        $activity->save();

        return redirect()->back()->with('success', 'Banner uploaded successfully.');
    }
}
