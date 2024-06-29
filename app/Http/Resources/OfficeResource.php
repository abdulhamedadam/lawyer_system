<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class OfficeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }

    public function updateData($request)
    {

        if (!empty($this->image)) {
            $image_path = Storage::disk('images')->url($this->image);

            $image = asset((Storage::disk('images')->exists($this->image)) ? $image_path : 'assets/images/blank.png');
        } else {
            $image = asset('assets/images/blank.png');

        }
        $name = $this->getTranslations('name');
        $address = $this->getTranslations('address');
        $currentLang = app()->getLocale();
//        $data= $this;
        $data['update_id'] = $this->id;
        $data['office_num'] = $this->office_num;
        $data['num_tax'] = $this->num_tax;
        $data['phone'] = $this->phone;
        $data['email'] = $this->email;
        $data['country_id'] = $this->country_id_fk;
        $data['emirate_id'] = $this->emirate;
        $data['city_id'] = $this->city;
        $data['district_id'] = $this->district;
        $data['user_name'] = $this->user_name;
        $data['status'] = $this->status;
        $data['whatsapp'] = $this->whatsapp;
        $data['image'] = $this->image;
        $data['name_en'] = $name['en'];
        $data['name_ar'] = $name['ar'];
        $data['name'] = $name[$currentLang];
        $data['address_ar'] = $address['ar'];
        $data['address_en'] = $address['en'];
        $data['address'] = $address[$currentLang];
        $data['fullImage'] = $image;

        return $data;
    }
}
