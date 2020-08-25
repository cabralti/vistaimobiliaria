<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    protected $table = 'mensalidades';
    protected $fillable = ['contrato_id', 'numero_parcela', 'data_vencimento', 'valor', 'status'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'id', 'contrato_id');
    }

    public function getDataVencimentoAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function getValorAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setValorAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['valor'] = floatval($this->convertStringToDouble($value));
        }
    }

    /**
     * @param $param
     * @return string|string[]|null
     */
    private function convertStringToDouble($param)
    {
        if (empty($param)) {
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param));
    }
}