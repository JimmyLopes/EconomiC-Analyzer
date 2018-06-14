<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 21:39
 */

class acao
{
    private $idAcao;
    private $codigo;
    private $nome;

    /**
     * acao constructor.
     * @param $id
     * @param $codigo
     * @param $nome
     */
    public function __construct($id, $codigo, $nome)
    {
        $this->idAcao = $id;
        $this->codigo = $codigo;
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getIdAcao()
    {
        return $this->idAcao;
    }

    /**
     * @param mixed $id
     */
    public function setIdAcao($id)
    {
        $this->idAcao = $id;
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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }




}