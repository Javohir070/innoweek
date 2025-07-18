<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Regions\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use MIMAXUZ\LRoles\Traits\HasPermissions;
use MIMAXUZ\LRoles\Models\XRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable  implements MustVerifyEmail
{
    use HasFactory, HasApiTokens, Notifiable, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'user_type',
        'author_id',
        'company_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'confirmed' => 'boolean',
    ];


    public function role()
    {
        return $this->hasOneThrough(XRoles::class, UserRole::class, 'user_id', 'id', 'id', 'x_roles_id');
    }


    /**
     * Get the ticket associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticket()
    {
        return $this->hasOne(UserTicket::class, 'user_id', 'id');
    }


    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }


    public function profession()
    {
        return $this->hasOne(Profession::class, 'id', 'profession_id');
    }

    public function visits()
    {
        return $this->hasMany(UserVisit::class, 'id', 'user_id');
    }

    public function visit()
    {
        //return $this->hasOne(UserVisit::class, 'user_id', 'id')->oldest();
        return $this->hasOneThrough(
            UserVisit::class,   // Ulanayotgan oxirgi model
            UserTicket::class,  // Oraliq model
            'user_id',          // Oraliq modelda user_id ustuni
            'ticket_id',        // Oxirgi modelda ticket_id ustuni
            'id',               // Asosiy modelda id ustuni (User jadvali)
            'id'                // Oraliq modelda id ustuni (UserTicket jadvali)
        )->orderBy('user_visits.created_at', 'asc');
    }

    public function visitExit()
    {
        //return $this->hasOne(UserVisit::class, 'user_id', 'id')->oldest();
        return $this->hasOneThrough(
            UserVisit::class,   // Ulanayotgan oxirgi model
            UserTicket::class,  // Oraliq model
            'user_id',          // Oraliq modelda user_id ustuni
            'ticket_id',        // Oxirgi modelda ticket_id ustuni
            'id',               // Asosiy modelda id ustuni (User jadvali)
            'id'                // Oraliq modelda id ustuni (UserTicket jadvali)
        )->where([['user_visits.status', 'exit']])->orderBy('user_visits.created_at', 'desc');
    }

    public function checker_enter()
    {
        return $this->hasMany(UserVisit::class, 'checker_id', 'id')->where([['user_visits.status', 'enter']]);
    }

    public function checker_exit()
    {
        return $this->hasMany(UserVisit::class, 'checker_id', 'id')->where([['user_visits.status', 'exit']]);
    }

}
