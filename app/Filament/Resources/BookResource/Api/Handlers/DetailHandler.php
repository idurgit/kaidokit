<?php

namespace App\Filament\Resources\BookResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\BookResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\BookResource\Api\Transformers\BookTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = BookResource::class;


    /**
     * Show Book
     *
     * @param Request $request
     * @return BookTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new BookTransformer($query);
    }
}
