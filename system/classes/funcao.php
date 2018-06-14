<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 21:53
 */

class funcao
{
    private $idFuncao;
    private $codFuncao;
    private $nomeFuncao;

    /**
     * funcao constructor.
     * @param $idFuncao
     * @param $codFuncao
     * @param $nomeFuncao
     */
    public function __construct($idFuncao, $codFuncao, $nomeFuncao)
    {
        $this->idFuncao = $idFuncao;
        $this->codFuncao = $codFuncao;
        $this->nomeFuncao = $nomeFuncao;
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
    public function getCodFuncao()
    {
        return $this->codFuncao;
    }

    /**
     * @param mixed $codFuncao
     */
    public function setCodFuncao($codFuncao)
    {
        $this->codFuncao = $codFuncao;
    }

    /**
     * @return mixed
     */
    public function getNomeFuncao()
    {
        return $this->nomeFuncao;
    }

    /**
     * @param mixed $nomeFuncao
     */
    public function setNomeFuncao($nomeFuncao)
    {
        $this->nomeFuncao = $nomeFuncao;
    }

}