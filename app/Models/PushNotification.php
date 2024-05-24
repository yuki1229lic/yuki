<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\NotificationEvent;

class PushNotification extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dispatchesEvents = [

        'created' => NotificationEvent::class,

    ];
}
