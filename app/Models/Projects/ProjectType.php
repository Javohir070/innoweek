<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;
    public $timestamps = true;

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
        return $this->hasMany(Project::class, 'type_id', 'id');
    }

    /**
     * Get all of the projects for the Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approved_projects()
    {
        return $this->hasMany(Project::class, 'type_id', 'id')->where('status', 'approved');
    }
}
