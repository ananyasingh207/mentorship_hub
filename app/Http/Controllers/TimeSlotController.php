<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class TimeSlotController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $slots = $user->timeSlots()
            ->with(['booking.startup'])
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'asc')
            ->get();
            
        return view('mentor.slots.index', compact('slots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
        ]);

        $startDateTime = Carbon::parse($validated['date'] . ' ' . $validated['start_time']);
        
        // Prevent past times on today's date
        if ($startDateTime->isPast()) {
            throw ValidationException::withMessages([
                'start_time' => 'Start time cannot be in the past.',
            ]);
        }

        // Prevent overlapping slots
        $overlapping = TimeSlot::where('mentor_id', auth()->id())
            ->where('date', $validated['date'])
            ->where(function ($query) use ($validated) {
                $query->where('start_time', '<', $validated['end_time'])
                      ->where('end_time', '>', $validated['start_time']);
            })->exists();

        if ($overlapping) {
            throw ValidationException::withMessages([
                'start_time' => 'This slot overlaps with an existing time slot.',
            ]);
        }

        auth()->user()->timeSlots()->create([
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'is_booked' => false,
        ]);

        return redirect()->back()->with('success', 'Time slot created successfully.');
    }
}
