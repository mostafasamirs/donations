<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\kiosk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deposit extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'kiosk_id',
        'amount',
        'image',
        'date',
    ];

    public function kiosks()
    {
        return $this->belongsTo(kiosk::class ,'kiosk_id','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class ,'user_id','id');
    }

    public function setDateAttribute( $value ) {
        $this->attributes['date'] = (new Carbon($value))->format('d/m/y');
    }
}
