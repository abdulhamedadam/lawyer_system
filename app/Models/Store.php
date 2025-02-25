<?php

namespace App\Models;

use Hazem\Zatca\Traits\HasZatcaDevice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    use HasZatcaDevice;

    protected $table='hazem_devices_zatca';
    protected $guarded=[];
}
