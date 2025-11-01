<?php

namespace Modules\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SalesBatch extends Model
{
    use SoftDeletes;

    protected $guarded  = [];

}
