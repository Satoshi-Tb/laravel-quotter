<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property-read \App\Models\Image|null $image
 */
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

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'profile_image_id');
    }

    public function getImagePath()
    {
        // イメージIDがセットされている場合のみ、imageデータを取得してパスを返す
        return $this->profile_image_id ? $this->image->path : null;
    }
}
