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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mensalidades()
    {
        return $this->hasMany(Mensalidade::class, 'contrato_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repasses()
    {
        return $this->hasMany(Repasse::class, 'contrato_id', 'id');
    }

    /**
     * Mensalidade: cobrança de aluguel que será enviada ao locatário com as taxas de aluguel, IPTU e Condomínio
     *
     * @return mixed
     */
    public function generateMonthlyFee()
    {
        $rentValue = ($this->convertStringToDouble($this['valor_aluguel']))
            + ($this->convertStringToDouble($this['valor_condominio']))
            + ($this->convertStringToDouble($this['valor_iptu']));

        if ($this['data_inicio'] != null) {
            list($day, $month, $year) = explode("/", $this['data_inicio']);
        } else {
            $day = date("d");
            $month = date("m");
            $year = date("Y");
        }

        for ($x = 1; $x <= $this['vigencia']; $x++) {
            $dueDate = date("Y-m-d", strtotime("+" . $x . " month", mktime(0, 0, 0, $month, $day, $year)));

            $monthly[] = [
                'contrato_id' => $this['id'],
                'numero_parcela' => $x,
                'data_vencimento' => $dueDate,
                'valor' => number_format($rentValue, 2, ',', '.'),
                'status' => 'aguardando'
            ];
        }

        return $monthly;
    }

    /**
     * Repasse: valor que será repassado da imobiliária para o locador do imóvel descontando a Taxa de Administração.
     * Aluguel e IPTU são repassados, condominio é pago pela imobiliária
     *
     * @return mixed
     */
    public function generateTransfer()
    {
        $transferValue = ($this->convertStringToDouble($this['valor_aluguel']) + $this->convertStringToDouble($this['valor_iptu'])) - ($this->convertStringToDouble($this['taxa_administracao']));

        if ($this['data_inicio'] != null) {
            list($day, $month, $year) = explode("/", $this['data_inicio']);
        } else {
            $day = date("d");
            $month = date("m");
            $year = date("Y");
        }

        for ($x = 1; $x <= $this['vigencia']; $x++) {
            $dueDate = date("Y-m-d", strtotime("+" . $x . " month", mktime(0, 0, 0, $month, $day, $year)));

            $transfer[] = [
                'contrato_id' => $this['id'],
                'numero_parcela' => $x,
                'data_vencimento' => $dueDate,
                'valor' =>  number_format($transferValue, 2, ',', '.'),
                'status' => 'aguardando'
            ];
        }

        return $transfer;
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
    public function convertStringToDate($param)
    {
        if (empty($param)) {
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }
}
