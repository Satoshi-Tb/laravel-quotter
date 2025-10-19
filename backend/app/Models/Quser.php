<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Quser extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory;
    use MustVerifyEmailTrait;

    protected $fillable = [
        'user_name',
        'display_name',
        'email',
        'password',
    ];

    public function quoots()
    {
        return $this->hasMany(Quoot::class);
    }
}
