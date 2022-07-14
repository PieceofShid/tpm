<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kanban extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function schedule(){
        return $this->hasMany(MasterSchedule::class, 'kanban_id');
    }
}
