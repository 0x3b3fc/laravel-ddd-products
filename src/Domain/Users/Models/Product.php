<?php

namespace Domain\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id','name', 'details',
    ];
    protected $fillable = [
        'name', 'details',
    ];
}
