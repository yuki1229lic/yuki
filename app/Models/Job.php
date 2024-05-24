<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    use HasFactory;

    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())->where('job_id', $this->id)->first();
    }
}
