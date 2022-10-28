<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
class Branch extends Model
{
    use HasFactory,HasRoles;
    protected $guard_name = 'web';

    protected $fillable=[
        'username',
        'company',
        'person',
        'phone',
        'tax',
        'country_id',
        'address',
        'logo',
        'password',
    ];
}
