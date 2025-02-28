<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pgvector\Laravel\Vector;
use Pgvector\Laravel\HasNeighbors;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    use HasNeighbors;

    protected $casts = [
        'embedding' => Vector::class,
        'embedding_700' => Vector::class,
    ];

    protected $guarded = ['id'];

    public function scopeSearch(Builder $query, string $keyword)
    {
        return $query->where('name', 'ILIKE', "%{$keyword}%")
            ->orWhere('description', 'ILIKE', "%{$keyword}%");
    }
}
