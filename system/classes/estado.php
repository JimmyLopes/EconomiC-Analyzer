<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 22:04
 */

class estado
{
    private $idEstado;
    private $uF;
    private $nomeEstado;
    private $idRegiao;

    /**
     * estado constructor.
     * @param $idEstado
     * @param $uF
     * @param $nomeEstado
     * @param $idRegiao
     */
    public function __construct($idEstado, $uF, $nomeEstado, $idRegiao)
    {
        $this->idEstado = $idEstado;
        $this->uF = $uF;
        $this->nomeEstado = $nomeEstado;
        $this->idRegiao = $idRegiao;
    }

    /**
     * @return mixed
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * @param mixed $idEstado
     */
    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;
    }

    /**
     * @return mixed
     */
    public function getUF()
    {
        return $this->uF;
    }

    /**
     * @param mixed $uF
     */
    public function setUF($uF)
    {
        $this->uF = $uF;
    }

    /**
     * @return mixed
     */
    public function getNomeEstado()
    {
        return $this->nomeEstado;
    }

    /**
     * @param mixed $nomeEstado
     */
    public function setNomeEstado($nomeEstado)
    {
        $this->nomeEstado = $nomeEstado;
    }

    /**
     * @return mixed
     */
    public function getIdRegiao()
    {
        return $this->idRegiao;
    }

    /**
     * @param mixed $idRegiao
     */
    public function setIdRegiao($idRegiao)
    {
        $this->idRegiao = $idRegiao;
    }
}