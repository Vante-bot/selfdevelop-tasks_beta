<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
   
    protected $with =['subtasks'];
    public function subtasks(){

        return $this->hasMany(subtask::class);//taskテーブルにサブタスクを紐づけた
        
        }

    protected $fillable = ['user_id','task'];     

    public static function boot(){
    parent::boot();
    static::deleting(function($task){
    // foreach($task->$subtasks()->get() as $subtask){
        $task->subtasks()->delete();
    });
     
}


}