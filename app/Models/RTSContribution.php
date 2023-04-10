<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RTSContribution extends Model
{
    use HasFactory;

    protected $table='rts_contribution';

    protected $fillable=[
        'rts_id',
        'contribution_amount_suggestion',
        'contribution_detail',
        'computed_contribution_amount',
    ];
}
