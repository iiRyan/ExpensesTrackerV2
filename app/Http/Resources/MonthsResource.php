<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'month' =>  $this->month,
                'income' => $this->income,
                'created_at' => $this->created_at
            ],
            'relationships' => [
                'id' => (string)$this->user->id,
                'userName' => $this->user->name,
                'userEmail' => $this->user->email
            ]
        ];
    }
}
