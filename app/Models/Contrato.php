<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos';
    protected $fillable = [
        'cliente_id',
        'proprietario_id',
        'imovel_id',
        'data_inicio',
        'data_fim',
        'dia_vencimento',
        'vigencia',
        'taxa_administracao',
        'valor_aluguel',
        'valor_condominio',
        'valor_iptu'
    ];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proprietario()
    {
        return $this->hasOne(Proprietario::class, 'id', 'proprietario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id', 'cliente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function imovel()
    {
        return $this->hasOne(Imovel::class, 'id', 'imovel_id');
    }

    public function getDataInicioAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function setDataInicioAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['data_inicio'] = $this->convertStringToDate($value);
        }
    }

    public function getDataFimAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function setDataFimAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['data_fim'] = $this->convertStringToDate($value);
        }
    }

    public function getTaxaAdministracaoAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setTaxaAdministracaoAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['taxa_administracao'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getValorAluguelAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setValorAluguelAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['valor_aluguel'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getValorCondominioAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setValorCondominioAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['valor_condominio'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getValorIptuAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setValorIptuAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['valor_iptu'] = floatval($this->convertStringToDouble($value));
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

    /**
     * @param $param
     * @return string|null
     * @throws \Exception
     */
    private function convertStringToDate($param)
    {
        if (empty($param)) {
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }
}