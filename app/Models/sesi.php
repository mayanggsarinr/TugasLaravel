<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $table = 'sesi';

    protected $fillable = ['nama'];

    public function jadwalKuliah()
    {
        return $this->hasMany(Jadwal::class, 'sesi_id', 'id');
    }
}
