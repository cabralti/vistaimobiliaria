<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    protected $table = 'imoveis';
    protected $fillable = ['proprietario_id', 'cep', 'uf', 'cidade', 'bairro', 'logradouro', 'numero'];
    public $timestamps = false;

    public function proprietario()
    {
        return $this->hasOne(Proprietario::class, 'id', 'proprietario_id');
    }
}