<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['estado', 'fecha', 'observacion', 'usuario_id'];

    public function usuario()
    {
    	return ($this->belongsTo('App\Usuario'));
    }

    public function pedidos_detalle()
    {
    	return ($this->hasMany('App\Pedido_Detalle'));
    }
}

?>