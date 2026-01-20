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
            'title' => $this->getTranslation('title', $locale),
            'description' => $this->getTranslation('description', $locale),
            'schema' => $this->getTranslation('schema', $locale),
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'name' => $this->getTranslation('name', $locale),
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->getTranslation('message', $locale),
            'created_at' => $this->created_at,
        ];
    }
}
