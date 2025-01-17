<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiTrainingData extends Model
{
    use HasFactory;
    protected $table='ai_training_data';
    protected $guarded=[];
}
