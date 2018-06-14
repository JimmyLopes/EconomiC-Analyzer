<?php

/**
 * Created by PhpStorm.
 * User: Jimmy
 * Date: 13/06/2018
 * Time: 23:32
 */

require_once "db/conexao.php";

class graficosDAO {

    public function totalPago()
    {
        global $pdo;
        try {
            $query = 'SELECT sum(db_value) as total FROM tb_payments;';
            $statement = $pdo->prepare($query);
            if ($statement->execute()) {  
                return $statement->fetchAll(PDO::FETCH_OBJ);
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function somaPagaUltimoMes()
    {
        global $pdo;
        try {
            $query = 'SELECT sum(db_value) as total FROM tb_payments where int_month = :month;';
            $statement = $pdo->prepare($query);
            $date = getdate();
            $statement->bindValue(":month", $date['mon'] - 1);
            if ($statement->execute()) {
                $obj = $statement->fetchAll(PDO::FETCH_OBJ);
                return $obj;
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
    
    public function mediaUltimoMes()
    {
        global $pdo;
        try {
            $query = 'SELECT count(id_payment) qtde, sum(db_value) soma, int_month mes, int_year ano 
                    FROM tb_payments group by int_month, int_year order by int_year desc, int_month desc limit 1;';
            $statement = $pdo->prepare($query);
            if ($statement->execute()) {
                $rs = $statement->fetchAll(PDO::FETCH_OBJ);
                               
                return $rs[0]->soma / $rs[0]->qtde;
               
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
    
    public function totalBeneficiarios()
    {
        global $pdo;
        try {
            $query = 'SELECT count(id_beneficiaries) AS total FROM tb_beneficiaries;';
            $statement = $pdo->prepare($query);
            if ($statement->execute()) {               
                return $statement->fetchAll(PDO::FETCH_OBJ)[0];
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
}