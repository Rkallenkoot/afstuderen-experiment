<?php

namespace App\Http\Resources;

use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image_url' => $this->image_url,
            'parent' => CategoryResource::make($this->whenLoaded('parent')),
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'books' => BookResource::collection($this->whenLoaded('books')),
            'links' => [
                'parent' => $this->when($this->isParent(), function() {
                    return route('userContext.category.show', $this->parent_id);
                }),
                'books' => route('userContext.category.books', $this->id),
                'children' => route('userContext.category.children', $this->id),
            ],
        ];
    }
}
