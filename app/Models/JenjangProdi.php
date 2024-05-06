<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenjangProdi extends Model
{
    use HasFactory;
    protected $table = "jenjang_prodi";
    protected $primaryKey = "id_jenjang_prodi";
    protected $fillable = [
        "nama_jenjang_prodi",
    ];
}
