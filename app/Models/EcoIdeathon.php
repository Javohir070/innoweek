<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Regions\Region;
class EcoIdeathon extends Model
{
    protected $fillable = [
        'user_id',
        'region_id',
        'full_name',
        'age',
        'phone',
        'email',
        'project_name',
        'project_brief',
        'project_goal',
        'project_problem',
        'implementation_plan',
        'team_info',
        'why_chosen',
        'presentation',
        'status',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
