<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mfakultas extends Model
{
    use HasFactory;
    protected $table = 'fakultas';
    protected $fillable = ['fakultas','prodi','kaprodi','foto'];
}
