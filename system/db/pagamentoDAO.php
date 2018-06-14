<?php
/**
 * Created by PhpStorm.
 * User: Jimmy
 * Date: 12/06/2018
 * Time: 15:17
 */


require_once "conexao.php";
require_once "classes/pagamento.php";

class pagamentoDAO
{
    
    public function remover($pagamento){
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM tb_payments WHERE id_payment = :idPagamento");
            $statement->bindValue(":id", $pagamento->getIdPagamento());
            if ($statement->execute()) {
                return "O Pagamento foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }
    public function salvar($pagamento){
        global $pdo;
        try {
            if ($pagamento->getIdPagamento() != "") {
                $statement = $pdo->prepare("UPDATE tb_payments SET  tb_city_id_city=:idCidade, 
                tb_functon_id_function=:idFuncao, tb_subfunction_id_subfunction=:idSubfuncao,
                tb_program_id_program=:idPrograma,tb_action_id_action=:idAcao, 
                tb_beneficiaries_id_beneficiaries=:idBeneficiario,tb_source_id_source=:idFonte,
                tb_files_id_file=:idArquivo,int_month=:mes,int_year=:year,db_value=:valor WHERE id_payment = :idPagamento;");
                $statement->bindValue(":id", $tb_payments->getIdPayment());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_payments (tb_city_id_city, tb_functon_id_function, 
                tb_subfunction_id_subfunction, tb_program_id_program, tb_action_id_action, 
                tb_beneficiaries_id_beneficiaries, tb_source_id_source ,tb_files_id_file,int_month,int_year, 
                db_value ) VALUES (:idCidade,:idFuncao,:idSubfuncao,:idPrograma,:idAcao,:idBeneficiario,:idFonte,
                :idArquivo,:mes,:year,:valor)");
            }
            $statement->bindValue(":idCidade",$pagamento->getIdCidade());
            $statement->bindValue(":idFuncao",$pagamento->getIdFuncao());
            $statement->bindValue(":idSubfuncao",$pagamento->getIdSubfuncao());
            $statement->bindValue(":idPrograma",$pagamento->getIdPrograma());
            $statement->bindValue(":idAcao",$pagamento->getIdAcao());
            $statement->bindValue(":idBeneficiario",$pagamento->getIdBeneficiario());
            $statement->bindValue(":idFonte",$pagamento->getIdFonte());
            $statement->bindValue(":idArquivo",$pagamento->getIdArquivo());
            $statement->bindValue(":mes",$pagamento->getMes());
            $statement->bindValue(":year",$pagamento->getYear());
            $statement->bindValue(":valor",$pagamento->getValor());
            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "Dados cadastrados com sucesso!";
                } else {
                    return "Erro ao tentar efetivar cadastro";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
    public function atualizar($pagamento){
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_payment, tb_city_id_city, tb_functon_id_function,
            tb_subfunction_id_subfunction, tb_program_id_program, tb_action_id_action, 
            tb_beneficiaries_id_beneficiaries, tb_source_id_source ,tb_files_id_file,int_month,int_year, 
            db_value FROM tb_payments WHERE id_payment = :idPagamento");
            $statement->bindValue(":idPagamento", $pagamento->getIdPagamento());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $pagamento->setPagamento($rs->idPagamento);
                $pagamento->setIdCidade($rs->idCidade);
                $pagamento->setIdFuncao($rs->idFuncao);
                $pagamento->setIdSubfuncao($rs->idSubfuncao);
                $pagamento->setIdPrograma($rs->idPrograma);
                $pagamento->setIdAcao($rs->idAcao);
                $pagamento->setIdBeneficiario($rs->idBeneficiario);
                $pagamento->setIdFonte($rs->idFonte);
                $pagamento->setIdArquivo($rs->idArquivo);
                $pagamento->setMes($rs->mes);
                $pagamento->setYear($rs->year);
                $pagamento->setValor($rs->valor);
                return $pagamento;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }

    public function tabelapaginada() {
        //carrega o banco
        global $pdo;
        //endereço atual da página
        $endereco = $_SERVER ['PHP_SELF'];
        /* Constantes de configuração */
        define('QTDE_REGISTROS', 10);
        define('RANGE_PAGINAS', 1);
        /* Recebe o número da página via parâmetro na URL */
        $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
        /* Calcula a linha inicial da consulta */
        $linha_inicial = ($pagina_atual -1) * QTDE_REGISTROS;
        /* Instrução de consulta para paginação com MySQL */
        $sql = "SELECT id_payment, tb_city_id_city, tb_functon_id_function,tb_subfunction_id_subfunction, tb_program_id_program, tb_action_id_action, tb_beneficiaries_id_beneficiaries, tb_source_id_source ,tb_files_id_file,int_month,int_year, db_value  FROM tb_payments LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);
        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_payments";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);
        /* Idêntifica a primeira página */
        $primeira_pagina = 1;
        /* Cálcula qual será a última página */
        $ultima_pagina  = ceil($valor->total_registros / QTDE_REGISTROS);
        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual -1 : 0 ;
        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual +1 : 0 ;
        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial  = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1 ;
        /* Cálcula qual será a página final do nosso range */
        $range_final   = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina ;
        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';
        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';
        if (!empty($dados)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
        <th>ID</th>
        <th>Cidade</th>
        <th>Função</th>
        <th>Subfunção</th>
        <th>Programa</th>
        <th>Ação</th>
        <th>Beneficiário</th>
        <th>Fonte</th>
        <th>Arquivo</th>
        <th>Mês</th>
        <th>Ano</th>
        <th>Valor</th>
        <th colspan='2'>Cidades</th>
       </tr>
     </thead>
     <tbody>";
            foreach($dados as $inst):
                echo "<tr>
        <td>$inst->id_payment</td>
        <td>$inst->tb_city_id_city</td>
        <td>$inst->tb_functon_id_function</td>
        <td>$inst->tb_subfunction_id_subfunction</td>
        <td>$inst->tb_program_id_program</td>
        <td>$inst->tb_action_id_action</td>
        <td>$inst->tb_beneficiaries_id_beneficiaries</td>
        <td>$inst->tb_source_id_source</td>
        <td>$inst->tb_files_id_file</td>
        <td>$inst->int_month</td>
        <td>$inst->int_year</td>
        <td>$inst->db_value</td>
        <td><a href='?act=upd&id=$inst->id_payment'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$inst->id_payment'><i class='ti-close'></i></a></td>
       </tr>";
            endforeach;
            echo"
     </tbody>
     </table>
     <div class='box-paginacao'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'>Primeira</a>
       <a class='box-navegacao $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'>Anterior</a>
";
            /* Loop para montar a páginação central com os números */
            for ($i=$range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;
                echo "<a class='box-numero $destaque' href='$endereco?page=$i'>$i</a>";
            endfor;
            echo "<a class='box-navegacao $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'>Próxima</a>
     <a class='box-navegacao $exibir_botao_final' href='$endereco?page=$ultima_pagina' title='Última Página'>Último</a>
     </div>";
        else:
            echo "<p class='bg-danger'>Nenhum registro foi encontrado!</p>
     ";
        endif;
    }
}