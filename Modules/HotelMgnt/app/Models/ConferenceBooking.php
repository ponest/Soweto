<?php

namespace Modules\HotelMgnt\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ConferenceBooking extends Model
{
    use SoftDeletes;

    protected $guarded  = [];
}
