<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Contact extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'contacts';
    protected $fillable=['name','email','phone','subject'];
}