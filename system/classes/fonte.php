<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 11/05/2018
 * Time: 22:02
 */

class fonte
{
    private $idfonte;
    private $goal;
    private $origem;
    private $periodicidade;

    /**
     * fonte constructor.
     * @param $idfonte
     * @param $goal
     * @param $origem
     * @param $periodicidade
     */
    public function __construct($idfonte, $goal, $origem, $periodicidade)
    {
        $this->idfonte = $idfonte;
        $this->goal = $goal;
        $this->origem = $origem;
        $this->periodicidade = $periodicidade;
    }

    /**
     * @return mixed
     */
    public function getIdfonte()
    {
        return $this->idfonte;
    }

    /**
     * @param mixed $idfonte
     */
    public function setIdfonte($idfonte)
    {
        $this->idfonte = $idfonte;
    }

    /**
     * @return mixed
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * @param mixed $goal
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;
    }

    /**
     * @return mixed
     */
    public function getOrigem()
    {
        return $this->origem;
    }

    /**
     * @param mixed $origem
     */
    public function setOrigem($origem)
    {
        $this->origem = $origem;
    }

    /**
     * @return mixed
     */
    public function getPeriodicidade()
    {
        return $this->periodicidade;
    }

    /**
     * @param mixed $periodicidade
     */
    public function setPeriodicidade($periodicidade)
    {
        $this->periodicidade = $periodicidade;
    }
}