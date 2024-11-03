<?php

namespace App\Http\Resources;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Ingredient
 */
class IngredientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'unit' => $this->whenPivotLoaded('ingredient_recipe', function () {
                return $this->pivot?->unit_display_name;
            }),
            'amount' => $this->whenPivotLoaded('ingredient_recipe', function () {
                return $this->pivot?->amount;
            }),
        ];
    }
}
