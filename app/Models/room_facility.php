<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room_facility extends Model
{
    use HasFactory;
    protected $table = 'room_facility';
    protected $primaryKey  = 'id';
}
