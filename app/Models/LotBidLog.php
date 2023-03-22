<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotBidLog extends Model
{
    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }
    
}
