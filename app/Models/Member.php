<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory,HasApiTokens;
    use Notifiable;

    protected $table = 'member';

    protected $primaryKey = 'member_id';

    protected $fillable = [
        'member_full_name',
        'member_email',
        'member_password',
        'member_role',
        'member_profile',
        'member_status',
    ];

    protected $hidden = [
        'member_password',
    ];

    public $timestamps = true;
}
