<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 22:01
 */

class regiao
{
    private $idRegiao;
    private $nomeRegiao;

    /**
     * regiao constructor.
     * @param $idRegiao
     * @param $nomeRegiao
     */
    public function __construct($idRegiao, $nomeRegiao)
    {
        $this->idRegiao = $idRegiao;
        $this->nomeRegiao = $nomeRegiao;
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

    /**
     * @return mixed
     */
    public function getNomeRegiao()
    {
        return $this->nomeRegiao;
    }

    /**
     * @param mixed $nomeRegiao
     */
    public function setNomeRegiao($nomeRegiao)
    {
        $this->nomeRegiao = $nomeRegiao;
    }


}