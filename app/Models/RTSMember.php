<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RTSMember extends Model
{
    use HasFactory;

    protected $table='rts__members';

    protected $fillable=[
        'members_name',
        'member_user_id',
        'rts_id'
    ];
}
