<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamValue extends Model
{
    use HasFactory;

    protected $table = "param_values";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'param_id', 'linked_id', 'linked_type', 'value'
    ];

    public function params()
    {
        return $this->morphMany(ParamValue::class, 'linked');
    }
}
