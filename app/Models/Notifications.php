<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Notifications extends Model
{
    use HasFactory,HasTranslations;
    protected $table = 'user_notifications';
    protected $fillable = ['from_user_id','from_user_name','to_user_id','to_user_name','content','title'
                          ,'status','type','action','add_at_day','add_at_time'];
    public $translatable = ['content','title','action'];

    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, \App::getLocale());
        }
        return $attributes;
    }
    /*----------------------------------------------------------------*/
    public function from_user()
    {
        return $this->belongsTo(Userapi::class,'from_user_id','id')->withTrashed();
    }

}
