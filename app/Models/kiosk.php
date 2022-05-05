<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class kiosk extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'name',
        // 'address',
        // 'safe',
    ];
    public function donations() {
        return $this->hasMany(Donation::class ,'kiosk_id');
    }
    public function users()
    {
         return $this->hasMany(User::class ,'kiosk_id');
        //return $this->hasMany(User::class ,'user_kiosks','user_id','kiosk_id');
    }
}
