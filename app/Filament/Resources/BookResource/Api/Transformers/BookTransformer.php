<?php
namespace App\Filament\Resources\BookResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Book;

/**
 * @property Book $resource
 */
class BookTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
