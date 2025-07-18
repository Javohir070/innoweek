<?php

namespace App\Models\Regions;

use App\Models\Projects\Project;
use App\Models\Projects\ProjectType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
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
    public function startup_projects()
    {
        return $this->hasMany(Project::class, 'region_id', 'id')->where([['type_id' , 1]]);
    }

    public function com_projects()
    {
        return $this->hasMany(Project::class, 'region_id', 'id')->where([['type_id', 2]]);
    }

    public function edu_projects()
    {
        return $this->hasMany(Project::class, 'region_id', 'id')->where([['type_id', 4]]);
    }

    public function local_projects()
    {
        return $this->hasMany(Project::class, 'region_id', 'id')->where([['type_id', 10]]);
    }

    /**
     * Get all of the projects for the Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'region_id', 'id');
    }
}
