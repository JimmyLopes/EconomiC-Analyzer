<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 22:05
 */

class subfuncao
{
    private $idSubfuncao;
    private $codSubfuncao;
    private $nomeSubfuncao;

    /**
     * subfuncao constructor.
     * @param $idSubfuncao
     * @param $codSubfuncao
     * @param $nomeSubfuncao
     */
    public function __construct($idSubfuncao, $codSubfuncao, $nomeSubfuncao)
    {
        $this->idSubfuncao = $idSubfuncao;
        $this->codSubfuncao = $codSubfuncao;
        $this->nomeSubfuncao = $nomeSubfuncao;
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
    public function getCodSubfuncao()
    {
        return $this->codSubfuncao;
    }

    /**
     * @param mixed $codSubfuncao
     */
    public function setCodSubfuncao($codSubfuncao)
    {
        $this->codSubfuncao = $codSubfuncao;
    }

    /**
     * @return mixed
     */
    public function getNomeSubfuncao()
    {
        return $this->nomeSubfuncao;
    }

    /**
     * @param mixed $nomeSubfuncao
     */
    public function setNomeSubfuncao($nomeSubfuncao)
    {
        $this->nomeSubfuncao = $nomeSubfuncao;
    }

}