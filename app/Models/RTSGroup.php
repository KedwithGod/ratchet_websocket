<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RTSGroup extends Model
{
    use HasFactory;
    protected $table='rts_group';

    protected $fillable=[
        'group_name',
        'coordinator_name',
        'coordinator_id',
    ];

    public function members()
{
    return $this->hasMany(RTSMember::class, 'rts_id', 'id');
}

}
