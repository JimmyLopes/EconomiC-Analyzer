<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 21:34
 */

class cidade
{
    private $idCidade;
    private $name;
    private $codigo;
    private $idEstado;

    public function __construct($idCidade, $name, $codigo, $idEstado)
    {
        $this->idCidade = $idCidade;
        $this->name = $name;
        $this->codigo = $codigo;
        $this->idEstado = $idEstado;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
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
     * cidade constructor.
     * @param $name
     * @param $codigo
     * @param $estado
     */



}