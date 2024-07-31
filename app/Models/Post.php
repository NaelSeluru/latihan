<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

// Model Post yang menggunakan HasFactory untuk membuat instance model dengan mudah
class Post extends Model
{
    use HasFactory;

    // Properti yang dapat diisi secara massal
    protected $fillable = [
        'nama',
        'ttl',
        'sekolah',
        'keterangan',
    ];

}