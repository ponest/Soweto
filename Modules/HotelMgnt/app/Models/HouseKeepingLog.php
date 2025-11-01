<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\General\Models\Staff;


class HouseKeepingLog extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function isExist($roomId, $date)
    {
        return self:: where([['room_id', $roomId], ['cleaned_on', $date]])->first();
    }

    public static function isExistOnEdit($roomId, $date, $id)
    {
        return self::where([['room_id', $roomId], ['cleaned_on', $date], ['id', '!=', $id]])->first();
    }

    public function room(){
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
