<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory; 
    use SoftDeletes;

    protected $fillable = [
        'subject',
        'task_title',
        'professor',
        'description',
        'deadline',
        'completed_at',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
        'deadline' => 'datetime',
        'completed_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    const STATUS_IN_PROGRESS = 0;
    const STATUS_PENDING = 1;
    const STATUS_COMPLETE = 2;
    const STATUS_DELETED = 3;

    public function getStatusTextAttribute()
    {
        $status = [
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_COMPLETE => 'Complete',
            self::STATUS_DELETED => 'Deleted',
        ];

        return $status[$this->attributes['status']];
    }
}
