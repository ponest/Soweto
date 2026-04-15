<?php

namespace Modules\Reports\Commands\Rooms;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Models\Booking;
use Modules\HotelMgnt\Models\Room;
use Modules\HotelMgnt\Models\RoomCheckInOut;
use Modules\Reports\Models\DailyRoomStatus;

class RoomsDailyStatusCommand
{
    public static function handle(): void
    {
        Log::info("Start Create Daily Room Status Command");

        $date = Carbon::yesterday();
        $formattedDate = $date->toDateString();

        $rooms = Room::all();

        foreach ($rooms as $room) {

            $guest = null;
            $arrival_date = null;
            $departure_date = null;
            $no_of_nights = 0;
            $pax = 0;

            if ($room->status == "Occupied") {

                $entry = RoomCheckInOut::where('room_id', $room->id)
                    ->whereNull('checked_out_at')
                    ->first();

                if ($entry) {
                    $booking = Booking::find($entry->booking_id);

                    if ($booking) {
                        $guest = $booking->client?->full_name;

                        $arrival = Carbon::parse($entry->checked_in_at);

                        $arrival_date = $arrival->toDateString();
                        $departure_date = $booking->proposed_end_date;

                        $no_of_nights = $arrival->startOfDay()
                            ->diffInDays(Carbon::parse($booking->proposed_end_date)->startOfDay());
                        $no_of_nights = max(1, $no_of_nights);
                        $pax = 1;
                    }
                }
            }

            DailyRoomStatus::updateOrCreate(
                [
                    'date' => $formattedDate,
                    'room_id' => $room->id,
                    'room_number' => $room->room_number,
                    'room_type' => $room->roomType?->name,
                    'rate' => $room->rate_per_night,
                ],
                [
                    'day' => $date->format('d'),
                    'month' => $date->format('m'),
                    'year' => $date->format('Y'),
                    'guest' => $guest,
                    'arrival_date' => $arrival_date,
                    'departure_date' => $departure_date,
                    'no_of_nights' => $no_of_nights,
                    'pax' => $pax,
                ]
            );
        }

        Log::info("Daily Room Status Created");
    }
}
