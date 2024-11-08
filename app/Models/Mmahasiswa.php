<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Mmahasiswa extends Model
{
    use HasFactory;

    

    protected $table = 'mahasiswa';
    protected $fillable = ['nim','nama','foto','jenis_kelamin','tempat_lahir','tanggal_lahir','fakultas_id','lat','long'];

    public function fakultas()
    {
        return $this->belongsTo(Mfakultas::class, 'fakultas_id');
    }
}
