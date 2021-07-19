<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matriks extends Model
{
    protected $table = "matriks";

    protected $fillable = ['name', 'file', 'path'];
}