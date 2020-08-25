<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Repasse extends Model
{
    protected $table = 'repasses';
    protected $fillable = ['contrato_id', 'numero_parcela', 'data_vencimento', 'valor', 'status'];
    public $timestamps = false;

    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'id', 'contrato_id');
    }
}