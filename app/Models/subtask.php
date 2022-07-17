<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subtask extends Model
{
    use HasFactory;
    
    public function subtasks(){
         return $this ->belongsTo(subtask::class);
    }
}
