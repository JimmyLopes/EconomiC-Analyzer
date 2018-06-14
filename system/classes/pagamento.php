<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 21:56
 */

class pagamento
{
    private $idPagamento;
    private $idCidade;
    private $idFuncao;
    private $idSubfuncao;
    private $idPrograma;
    private $idAcao;
    private $idBeneficiario;
    private $idFonte;
    private $idArquivo;
    private $mes;
    private $year;
    private $valor;

    /**
     * pagamento constructor.
     * @param $idPagamento
     * @param $idCidade
     * @param $idFuncao
     * @param $idSubfuncao
     * @param $idPrograma
     * @param $idAcao
     * @param $idBeneficiario
     * @param $idFonte
     * @param $idArquivo
     * @param $mes
     * @param $year
     * @param $valor
     */
    public function __construct($idPagamento, $idCidade, $idFuncao, $idSubfuncao, $idPrograma, $idAcao, $idBeneficiario, $idFonte, $idArquivo, $mes, $year, $valor)
    {
        $this->idPagamento = $idPagamento;
        $this->idCidade = $idCidade;
        $this->idFuncao = $idFuncao;
        $this->idSubfuncao = $idSubfuncao;
        $this->idPrograma = $idPrograma;
        $this->idAcao = $idAcao;
        $this->idBeneficiario = $idBeneficiario;
        $this->idFonte = $idFonte;
        $this->idArquivo = $idArquivo;
        $this->mes = $mes;
        $this->year = $year;
        $this->valor = $valor;
    }

    /**
     * @return mixed
     */
    public function getIdPagamento()
    {
        return $this->idPagamento;
    }

    /**
     * @param mixed $idPagamento
     */
    public function setIdPagamento($idPagamento)
    {
        $this->idPagamento = $idPagamento;
    }

    /**
     * @return mixed
     */
    public function getIdCidade()
    {
        return $this->idCidade;
    }

    /**
     * @param mixed $idCidade
     */
    public function setIdCidade($idCidade)
    {
        $this->idCidade = $idCidade;
    }

    /**
     * @return mixed
     */
    public function getIdFuncao()
    {
        return $this->idFuncao;
    }

    /**
     * @param mixed $idFuncao
     */
    public function setIdFuncao($idFuncao)
    {
        $this->idFuncao = $idFuncao;
    }

    /**
     * @return mixed
     */
    public function getIdSubfuncao()
    {
        return $this->idSubfuncao;
    }

    /**
     * @param mixed $idSubfuncao
     */
    public function setIdSubfuncao($idSubfuncao)
    {
        $this->idSubfuncao = $idSubfuncao;
    }

    /**
     * @return mixed
     */
    public function getIdPrograma()
    {
        return $this->idPrograma;
    }

    /**
     * @param mixed $idPrograma
     */
    public function setIdPrograma($idPrograma)
    {
        $this->idPrograma = $idPrograma;
    }

    /**
     * @return mixed
     */
    public function getIdAcao()
    {
        return $this->idAcao;
    }

    /**
     * @param mixed $idAcao
     */
    public function setIdAcao($idAcao)
    {
        $this->idAcao = $idAcao;
    }

    /**
     * @return mixed
     */
    public function getIdBeneficiario()
    {
        return $this->idBeneficiario;
    }

    /**
     * @param mixed $idBeneficiario
     */
    public function setIdBeneficiario($idBeneficiario)
    {
        $this->idBeneficiario = $idBeneficiario;
    }

    /**
     * @return mixed
     */
    public function getIdFonte()
    {
        return $this->idFonte;
    }

    /**
     * @param mixed $idFonte
     */
    public function setIdFonte($idFonte)
    {
        $this->idFonte = $idFonte;
    }

    /**
     * @return mixed
     */
    public function getIdArquivo()
    {
        return $this->idArquivo;
    }

    /**
     * @param mixed $idArquivo
     */
    public function setIdArquivo($idArquivo)
    {
        $this->idArquivo = $idArquivo;
    }

    /**
     * @return mixed
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * @param mixed $mes
     */
    public function setMes($mes)
    {
        $this->mes = $mes;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }



}