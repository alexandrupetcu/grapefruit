<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'price',
    ];

    protected $filterFields = [
        'price',
        'title',
        'location', // relation
    ];

}
