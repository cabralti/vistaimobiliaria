<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Proprietario extends Model
{
    protected $table = 'proprietarios';
    protected $fillable = ['nome', 'email', 'telefone', 'dia_repasse'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imoveis()
    {
        return $this->hasMany(Imovel::class, 'proprietario_id', 'id');
    }
}