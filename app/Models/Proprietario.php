<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Proprietario extends Model
{
    protected $table = 'proprietarios';
    protected $fillable = ['nome', 'email', 'telefone', 'dia_repasse'];
    public $timestamps = false;
}