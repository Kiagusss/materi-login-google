<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'email',
        'social_id',
        'social_type',
        'remember_token'
    ];
}
