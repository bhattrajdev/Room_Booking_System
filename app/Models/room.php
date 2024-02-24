<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'room_no', 'category_id', 'price', 'description'];
    protected $table = 'room';
    protected $primaryKey = 'id';
}
