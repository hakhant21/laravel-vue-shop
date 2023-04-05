<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
       
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'userVendor' => $this->userVendor
            // ->map(function($uv) {
            //     return [
            //         'id' => $uv->id,
            //         'user_id' => $uv->user_id,
            //         'vendor_id' => $uv->vendor_id,
            //         'sub_role' => $uv->sub_role,
            //         'vendor' => [
            //             'id' => $uv->vendor->id,
            //             'name' => $uv->vendor->name,
            //             'phone' => $uv->vendor->phone,
            //             'contact_person' => $uv->vendor->contact_person,
            //             'description' => $uv->vendor->description,
            //             'address' => $uv->vendor->address,
            //         ],
            //     ];
            // }),
        ];
    }
}
