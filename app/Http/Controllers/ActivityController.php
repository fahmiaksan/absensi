<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        if ($role != 'admin') {
            $activities = Activity::where('user_id', auth()->id())->paginate(10);
            return view('activities.index', compact('activities'));
        }
        $activities = Activity::with('user')->paginate(10);
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'activity_text' => 'required|string',
        ]);

        Activity::create([
            'user_id' => auth()->id(),  // Menyimpan id user yang login
            'name' => $validated['name'],
            'activity_text' => $request->activity_text,
            'status' => 'pending',  // Default status pending
        ]);

        return redirect()->route('activities.index')->with('success', 'Activity created successfully!');
    }

    public function approve($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->status = 'approved';
        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Activity approved!');
    }

    public function reject($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->status = 'rejected';
        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Activity rejected!');
    }

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activities.edit', compact('activity'));
    }

    public function updateStatus($id, $status)
    {
        // Temukan aktivitas berdasarkan ID
        $activity = Activity::findOrFail($id);
        $activity->status = $status;
        $activity->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status aktivitas berhasil diubah!');
    }

    public function update(Request $request, Activity $activity)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'activity_text' => 'required|string',
        ]);

        try {
            // Update activity
            $activity->update($validatedData);

            // Redirect dengan pesan sukses
            return redirect()
                ->route('activities.index')
                ->with('success', 'Activity updated successfully.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal
            return redirect()
                ->route('activities.edit', $activity->id)
                ->with('error', 'Failed to update activity: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully!');
    }
}
