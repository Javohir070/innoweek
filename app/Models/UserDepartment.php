<?php

namespace App\Models;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    use HasFactory;
    //Role Management
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    /**
     * Get all of the projects for the Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'department_id', 'id');
    }

    /**
     * Get all of the projects for the Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approved_projects()
    {
        return $this->hasMany(Project::class, 'department_id', 'id')->where('status', 'approved');
    }
}
