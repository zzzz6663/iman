<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'lastname',
        'username',
        'phone',
        'company',
        'address',
        'user_id',
        'branch_id',
        'country_id',
        'person',
        'tax',
        'logo',
        'role',
        'contact',
        'mobile',

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function logo_img()
    {
        if ($this->logo) {
            return   asset('/media/branch/' . $this->logo);
        }
    }
    public function branch(){
        return $this->belongsTo(User::class,'branch_id','id');
    }
    // public function products(){
    //     return $this->belongsTo(User::class,'branch_id','id');
    // }
    public function branch_products(){
        return $this->belongsToMany(Product::class)->withPivot(['show','traffic_code']);
    }
    public function product_traffic_code($product){
        $is_exist=  $this->branch_products()->where('product_id', $product->id)->first();
       if( $is_exist ){
        return $is_exist->pivot->traffic_code;
       }
    }


    public function orders(){
        return $this->hasMany(Order::class,'client_id','id');
    }
}
