<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Translatable\HasTranslations;
class Maindata extends Model
{
    use HasApiTokens, HasFactory, Notifiable,HasTranslations;
    protected $table = 'maindatas';
    protected $fillable=['image','name','email','address','fax','phone','description'];
    public $translatable = ['name','address','description'];

    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            $image_path = Storage::disk('images')->url($value);

            return asset((Storage::disk('images')->exists($value)) ? $image_path : 'assets/media/svg/files/blank-image-dark.svg');

        }else{
            return asset('assets/media/svg/files/blank-image-dark.svg');

        }
    }
}
