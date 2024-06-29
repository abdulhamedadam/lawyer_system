<?php

namespace App\Http\Resources\Admin\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitMainSettingResource extends JsonResource
{

    /*----------------------------------------------*/
    public function main_setting_resource(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    /*------------------------------------------*/
}
