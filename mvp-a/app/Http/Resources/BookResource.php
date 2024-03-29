<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'isbn' => $this->isbn,
            'eISBN' => $this->eISBN,
            'publisher_id' => $this->publisher_id,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'publisher' => new PublisherResource($this->whenLoaded('publisher')),
        ];
    }
}
