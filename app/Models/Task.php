<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "parent_id",
        "description",
        "department_id",
        "performed_by",
        "title",
        "priority",
        "start_date",
        "end_date",
        "progress",
        "result",
        "file",
        "status"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
