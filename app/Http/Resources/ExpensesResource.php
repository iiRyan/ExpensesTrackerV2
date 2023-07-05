<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpensesResource extends JsonResource
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
                'description' =>  $this->description,
                'amount' => $this->amount,
                'bank_account' => $this->bank_account,
                'status'       => $this->status,
                'created_at' => $this->created_at
            ],
            'relationships' => [
                'id' => (string)$this->month->id,
                'month' => $this->month->month,
                'income' => $this->month->income
            ]
        ];
    }
}
