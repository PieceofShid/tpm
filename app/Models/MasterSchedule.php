<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'shift_id', 'machine_id', 'kanban_id', 'status'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shift(){
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function machine(){
        return $this->belongsTo(Machine::class, 'machine_id');
    }

    public function kanban(){
        return $this->belongsTo(Kanban::class, 'kanban_id');
    }
}
