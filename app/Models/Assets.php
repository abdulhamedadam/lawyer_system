<?php

namespace App\Models;

use App\Models\Admin\Employees;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $table = 'tbl_assets';
    protected $guarded = [];


    /*******************************************/
    public function AssetType()
    {
        return $this->belongsTo(AssetsType::class,'assets_type','id');
    }
    /******************************************/
    public function Supplier()
    {
        return $this->belongsTo(Suppliers::class,'supplier','id');
    }
    /******************************************/
    public function ReceivedBy()
    {
        return $this->belongsTo(Employees::class,'received_by','id');
    }
}
