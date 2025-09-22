<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTask extends Model
{
    /** @use HasFactory<\Database\Factories\GroupTaskFactory> */
    use HasFactory;

    protected $fillable = [
        'group_id',
        'task_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
