<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = "rooms";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'home_id'
    ];

    public function devices() {
        return $this->belongsToMany(Device::class, 'room_devices')->withTimestamps()->withPivot(['id', 'cust_id', 'name']);
    }
}
