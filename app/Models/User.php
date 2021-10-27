<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Authenticatable
{
     const ADMIN_ROLE = 1;
     const EMPLOPYER_ROLE = 2;
    /**
     * @var mixed
     */

    use HasApiTokens,HasFactory, Notifiable,SoftDeletes;



    public static function role($id)
    {
        return DB::table('roles')->select('name')->where('id',$id)->first();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventaries()
    {
        return $this->hasMany(Inventory::class);
    }

    public function inventoryitem(){

        return $this->hasMany(Inventoryitem::class);
    }
//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'roles_id'
    ];
//    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
////        'email_verified_at' => 'datetime',
//    ];
}
