<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'completed', 'deadline'];

    protected $casts = [
        'completed' => 'boolean',
        'deadline' => 'datetime',
    ];

    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }

    public function getProgressAttribute()
    {
        $total = $this->subtasks()->count();
        if ($total === 0) {
            return 0;
        }
        $completed = $this->subtasks()->where('completed', true)->count();
        return round(($completed / $total) * 100);
    }
}