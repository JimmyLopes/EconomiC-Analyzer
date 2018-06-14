<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 21:49
 */

class arquivo
{
    private $idArquivo;
    private $nomeArquivo;
    private $mesArquivo;
    private $anoArquivo;

    /**
     * arquivo constructor.
     * @param $idArquivo
     * @param $nomeArquivo
     * @param $mesArquivo
     * @param $anoArquivo
     */
    public function __construct($idArquivo, $nomeArquivo, $mesArquivo, $anoArquivo)
    {
        $this->idArquivo = $idArquivo;
        $this->nomeArquivo = $nomeArquivo;
        $this->mesArquivo = $mesArquivo;
        $this->anoArquivo = $anoArquivo;
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
    public function getNomeArquivo()
    {
        return $this->nomeArquivo;
    }

    /**
     * @param mixed $nomeArquivo
     */
    public function setNomeArquivo($nomeArquivo)
    {
        $this->nomeArquivo = $nomeArquivo;
    }

    /**
     * @return mixed
     */
    public function getMesArquivo()
    {
        return $this->mesArquivo;
    }

    /**
     * @param mixed $mesArquivo
     */
    public function setMesArquivo($mesArquivo)
    {
        $this->mesArquivo = $mesArquivo;
    }

    /**
     * @return mixed
     */
    public function getAnoArquivo()
    {
        return $this->anoArquivo;
    }

    /**
     * @param mixed $anoArquivo
     */
    public function setAnoArquivo($anoArquivo)
    {
        $this->anoArquivo = $anoArquivo;
    }

}