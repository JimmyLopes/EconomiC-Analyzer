<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 22:00
 */

class programa
{
    private $idPrograma;
    private $codPrograma;
    private $nomePrograma;

    /**
     * programa constructor.
     * @param $idPrograma
     * @param $codPrograma
     * @param $nomePrograma
     */
    public function __construct($idPrograma, $codPrograma, $nomePrograma)
    {
        $this->idPrograma = $idPrograma;
        $this->codPrograma = $codPrograma;
        $this->nomePrograma = $nomePrograma;
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
    public function getCodPrograma()
    {
        return $this->codPrograma;
    }

    /**
     * @param mixed $codPrograma
     */
    public function setCodPrograma($codPrograma)
    {
        $this->codPrograma = $codPrograma;
    }

    /**
     * @return mixed
     */
    public function getNomePrograma()
    {
        return $this->nomePrograma;
    }

    /**
     * @param mixed $nomePrograma
     */
    public function setNomePrograma($nomePrograma)
    {
        $this->nomePrograma = $nomePrograma;
    }
}