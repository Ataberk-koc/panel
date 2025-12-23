<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SSSResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', 'tr');
        return [
            'id' => $this->id,
            'question' => $this->getTranslation('question', $locale),
            'answer' => $this->getTranslation('answer', $locale),
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
        ];
    }
}
