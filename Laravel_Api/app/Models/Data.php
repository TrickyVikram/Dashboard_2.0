<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Data extends Model
{
    use HasFactory;

    protected $table = 'datas';

    protected $fillable = [
        'end_year',
        'citylng',
        'citylat',
        'intensity',
        'sector',
        'topic',
        'insight',
        'swot',
        'url',
        'region',
        'start_year',
        'impact',
        'added',
        'published',
        'city',
        'country',
        'relevance',
        'pestle',
        'source',
        'title',
        'likelihood',
    ];

    protected $casts = [
        'added' => 'datetime',
        'published' => 'datetime',
    ];
}



