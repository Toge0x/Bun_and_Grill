<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoPago extends Model
{
    protected $table = 'info_pago';

    protected $fillable = [
        'emailCliente',
        'numTarjeta',
        'caducidad',
        'cvv',
        'titular'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'emailCliente', 'email');
    }
}
