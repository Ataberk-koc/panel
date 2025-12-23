<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'tr');
        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $locale),
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->getTranslation('message', $locale),
            'created_at' => $this->created_at,
        ];
    }
}
