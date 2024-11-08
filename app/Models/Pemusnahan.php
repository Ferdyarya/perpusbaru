<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemusnahan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_bukurusak','kondisi','qty','tanggal'
    ];
    public function masterbukurusak()
    {
        return $this->hasOne(Rusak::class, 'id', 'id_bukurusak');
    }
}
