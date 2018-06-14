<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 21:45
 */

class beneficiario
{
    private $idBeneficiario;
    private $nis;
    private $nomeBeneficiario;

    /**
     * beneficiario constructor.
     * @param $idBeneficiario
     * @param $nis
     * @param $nomeBeneficiario
     */
    public function __construct($idBeneficiario, $nis, $nomeBeneficiario)
    {
        $this->idBeneficiario = $idBeneficiario;
        $this->nis = $nis;
        $this->nomeBeneficiario = $nomeBeneficiario;
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
    public function getNis()
    {
        return $this->nis;
    }

    /**
     * @param mixed $nis
     */
    public function setNis($nis)
    {
        $this->nis = $nis;
    }

    /**
     * @return mixed
     */
    public function getNomeBeneficiario()
    {
        return $this->nomeBeneficiario;
    }

    /**
     * @param mixed $nomeBeneficiario
     */
    public function setNomeBeneficiario($nomeBeneficiario)
    {
        $this->nomeBeneficiario = $nomeBeneficiario;
    }


}