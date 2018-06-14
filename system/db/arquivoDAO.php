<?php
/**
 * Created by PhpStorm.
 * User: Jimmy
 * Date: 28/05/2018
 * Time: 14:01
 */

require_once "conexao.php";
require_once "classes/arquivo.php";

class arquivoDAO
{
    public function remover($arquivo)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM tb_files WHERE id_file = :idArquivo");
            $statement->bindValue(":idArquivo", $arquivo->getIdArquivo());
            if ($statement->execute()) {
                return "O aruivo foi excluída com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($arquivo)
    {
        global $pdo;
        try {
            if ($arquivo->getIdArquivo() != "") {
                $statement = $pdo->prepare("UPDATE tb_files SET str_name_file=:nomeArquivo, str_month=:mesArquivo, str_year=:anoArquivo  WHERE id_file = :idArquivo;");
                $statement->bindValue(":idArquivo", $arquivo->getIdArquivo());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_files (str_name_file, str_month, str_year) VALUES (:nomeArquivo, :mesArquivo, :anoArquivo)");
            }
            $statement->bindValue(":nomeArquivo", $arquivo->getNomeArquivo());
            $statement->bindValue(":mesArquivo", $arquivo->getMesArquivo());
            $statement->bindValue(":anoArquivo", $arquivo->getAnoArquivo());

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

    public function atualizar($arquivo)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT idArquivo, str_name_file, str_month, str_year FROM tb_file WHERE id_file = :idArquivo");
            $statement->bindValue(":idArquivo", $arquivo->getIdArquivo());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $arquivo->setIdArquivo($rs->idArquivo);
                $arquivo->setNome($rs->nome);
                $arquivo->setCodigo($rs->codigo);
                return $arquivo;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
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
        $sql = "SELECT id_file, str_name_file, str_month,str_year FROM tb_files LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);
        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_files";
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
        <th>Nome</th>
        <th>Mês</th>
        <th>Ano</th>
        <th colspan='2'>Arquivos</th>
       </tr>
     </thead>
     <tbody>";
            foreach($dados as $inst):
                echo "<tr>
        <td>$inst->id_file</td>
        <td>$inst->str_name_file</td>
        <td>$inst->str_month</td>
        <td>$inst->str_year</td>
        <td><a href='?act=upd&id=$inst->id_file'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$inst->id_file'><i class='ti-close'></i></a></td>
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