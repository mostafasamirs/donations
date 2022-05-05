<?php

namespace App\Models;

use App\Models\kiosk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shift extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'kiosk_id',
        'start_time',
        'end_time',
    ];


    public function kiosks()
    {
        return $this->belongsTo(kiosk::class ,'kiosk_id','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class ,'user_id','id');
    }

}
