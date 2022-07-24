<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $fillable = ['master_schedule_id', 'problem'];

    public function schedule(){
        return $this->belongsTo(MasterSchedule::class, 'master_schedule_id');
    }
}
