<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use App\Models\Booking;
use App\Models\MentorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(Request $request, TimeSlot $slot)
    {
        if ($slot->is_booked) {
            return redirect()->back()->with('error', 'This slot is already booked.');
        }

        // Validate mentor request status
        $hasAcceptedRequest = MentorRequest::where('startup_id', auth()->id())
            ->where('mentor_id', $slot->mentor_id)
            ->where('status', 'accepted')
            ->exists();

        if (!$hasAcceptedRequest) {
            return redirect()->back()->with('error', 'You must have an accepted mentorship request to book this mentor.');
        }

        try {
            DB::transaction(function () use ($slot) {
                // Lock row to prevent race conditions / double booking
                $lockedSlot = TimeSlot::where('id', $slot->id)->lockForUpdate()->first();
                
                if ($lockedSlot->is_booked) {
                    throw new \Exception('Slot is already booked.');
                }

                $lockedSlot->update(['is_booked' => true]);

                Booking::create([
                    'startup_id' => auth()->id(),
                    'mentor_id' => $lockedSlot->mentor_id,
                    'slot_id' => $lockedSlot->id,
                    'status' => 'scheduled',
                ]);
            });
            
            return redirect()->route('startup.bookings.index')->with('success', 'Session booked successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sorry, this slot just got booked by someone else.');
        }
    }

    public function startupIndex()
    {
        $bookings = auth()->user()->startupBookings()
            ->with(['mentor', 'timeSlot'])
            ->latest()
            ->get();
            
        return view('startup.bookings.index', compact('bookings'));
    }

    public function mentorIndex()
    {
        $bookings = auth()->user()->mentorBookings()
            ->with(['startup', 'timeSlot'])
            ->latest()
            ->get();
            
        return view('mentor.bookings.index', compact('bookings'));
    }

    public function complete(Booking $booking)
    {
        if ($booking->mentor_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'scheduled') {
            return redirect()->back()->with('error', 'Only scheduled bookings can be marked as completed.');
        }

        $booking->update([
            'status' => 'completed',
        ]);

        return redirect()->route('mentor.slots.index')->with('success', 'Booking marked as completed successfully!');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->startup_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'scheduled') {
            return redirect()->back()->with('error', 'Only scheduled bookings can be cancelled.');
        }

        DB::transaction(function () use ($booking) {
            $booking->update([
                'status' => 'cancelled',
            ]);

            if ($booking->timeSlot) {
                $booking->timeSlot->update([
                    'is_booked' => false,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}
