<?php

namespace Marshmallow\HistoryTracking;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    /**
     * Don't guard any fields in this model
     * @var array
     */
    protected $guarded = [];
}
