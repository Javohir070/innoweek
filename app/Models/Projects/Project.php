<?php

namespace App\Models\Projects;

use App\Models\Regions\Country;
use App\Models\User;
use App\Models\UserDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
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
     * Get all of the districts for the Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gallery()
    {
        return $this->hasMany(ProjectGallery::class, 'project_id', 'id');
    }

    public function image()
    {
        return $this->hasOne(ProjectGallery::class, 'project_id', 'id')->oldest();
    }


    /**
     * Get the author associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }


    /**
     * Get the author associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function area()
    {
        return $this->hasOne(ProjectArea::class, 'id', 'area_id');
    }


    /**
     * Get the country associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    /**
     * Get the category associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(ProjectCategory::class, 'id', 'category_id');
    }

    /**
     * Get the project_type associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project_type()
    {
        return $this->hasOne(ProjectType::class, 'id', 'type_id');
    }

    /**
     * Get the project_type associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department()
    {
        return $this->hasOne(UserDepartment::class, 'id', 'department_id');
    }
}
