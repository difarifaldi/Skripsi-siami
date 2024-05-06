<?php

namespace Modules\KUI\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\KUI\Database\factories\InstrumentFactory;
use App\Models\User;

class Instrument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];
    protected $table = "kui_instruments";



    protected static function newFactory(): InstrumentFactory
    {
        //return InstrumentFactory::new();
    }

    public function penanggungJawab()
    {
        return $this->hasOne(User::class, 'id', 'penanggung_jawab');
    }

    public function auditeeUser()
    {
        return $this->hasOne(User::class, 'id', 'auditee');
    }

    public function auditorUser()
    {
        return $this->hasOne(User::class, 'id', 'auditor');
    }
}
