<?php

require_once "classes/template.php";
require_once "db/pagamentoDAO.php";

$template = new Template();

$template->header();

$template->sidebar();

$template->mainpanel();

$object = new pagamentoDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $cidade = (isset($_POST["cidade"]) && $_POST["cidade"] != null) ? $_POST["cidade"] : "";
    $funcao = (isset($_POST["funcao"]) && $_POST["funcao"] != null) ? $_POST["funcao"] : "";
    $subfuncao = (isset($_POST["subfuncao"]) && $_POST["subfuncao"] != null) ? $_POST["subfuncao"] : "";
    $programa = (isset($_POST["programa"]) && $_POST["programa"] != null) ? $_POST["programa"] : "";
    $acao = (isset($_POST["acao"]) && $_POST["acao"] != null) ? $_POST["acao"] : "";
    $beneficiario = (isset($_POST["beneficiario"]) && $_POST["beneficiario"] != null) ? $_POST["beneficiario"] : "";
    $fonte = (isset($_POST["fonte"]) && $_POST["fonte"] != null) ? $_POST["fonte"] : "";
    $arquivo = (isset($_POST["arquivo"]) && $_POST["arquivo"] != null) ? $_POST["arquivo"] : "";
    $mes = (isset($_POST["mes"]) && $_POST["mes"] != null) ? $_POST["mes"] : "";
    $year = (isset($_POST["year"]) && $_POST["year"] != null) ? $_POST["year"] : "";
    $valor = (isset($_POST["valor"]) && $_POST["valor"] != null) ? $_POST["valor"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $cidade = NULL;
    $funcao = NULL;
    $subfuncao = NULL;
    $programa = NULL;
    $acao = NULL;
    $beneficiario = NULL;
    $fonte = NULL;
    $arquivo = NULL;
    $mes = NULL;
    $year = NULL;
    $valor = NULL;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $pagamento = new pagamento($id, '', '','','','','','','');

    $resultado = $object->atualizar($pagamento);
    $cidade = $resultado->getIdCidade();
    $funcao = $resultado->getIdFuncao();
    $subfuncao = $resultado->setIdSubfuncao();
    $programa = $resultado->getIdPrograma();
    $acao = $resultado->getIdAcao();
    $beneficiario = $resultado->getIdBeneficiario();
    $fonte = $resultado->getIdFonte();
    $arquivo = $resultado->getIdArquivo();
    $mes = $resultado->getMes();
    $year = $resultado->getYear();
    $valor = $resultado->getValor();

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $cidade != "" && $funcao != ""&& $subfuncao != ""&& $programa != ""&& $acao != ""&& $beneficiario != ""&& $fonte != ""&& $arquivo != "") {
    $pagamento = new pagamento($id, $cidade,  $funcao, $subfuncao, $programa, $acao, $beneficiario, $fonte, $arquivo, $mes, $year, $valor);
    $msg = $object->salvar($pagamento);
    $id = null;
    $cidade = null;
    $funcao = null;
    $subfuncao = NULL;
    $programa = NULL;
    $acao = NULL;
    $beneficiario = NULL;
    $fonte = NULL;
    $arquivo = NULL;
    $mes = NULL;
    $year = NULL;
    $valor = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $pagamento = new Pagamentos($id, '', '','','','','','','','','','');
    $msg = $object->remover($pagamento);
    $id = null;
}



    $queryFunctions = "SELECT * FROM tb_functions";
    $statement = $pdo->prepare($queryFunctions);

    if ($statement->execute()) {
    $resultadoFunctions = $statement->fetchAll(PDO::FETCH_OBJ);
    } else {
    echo "Nenhum Registro Encontrado";
    }
                                
    ?>


<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Pagamentos</h4>
                        <p class='category'>Lista de Pagamentos do sistema</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save&id=" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Cidade:
                            <select name="cidade">
                                <?php

                                $query = "SELECT * FROM tb_city";

                                foreach ($pdo->query($query) as $value) {
                                    $resultado[] = $value;
                                }

                                if(isset($resultado)) {
                                    foreach ($resultado as $r){
                                        echo "<option value=$r[id_city]>$r[str_name_city]</option>";
                                    }
                                } else {
                                    echo "Nenhum Registro Encontrado";
                                }
                                ?>
                                </select>

                                Funcão:
                            <select name="funcao">
                            <?php 
                            foreach ($resultadoFunctions as $r){
                                        echo "<option value=". $r->id_function." selected>".$r->str_name_function."</option>";
                                    }
                            ?>
                            </select>
                                Sub Funcão:

                            <select name="subfuncao">
                                <?php
                     
                                $query = "SELECT * FROM tb_subfunctions";
                                $statement = $pdo->prepare($query);

                                if ($statement->execute()){
                                    $resultado = $statement->fetchAll(PDO::FETCH_OBJ);
                                } else{
                                    echo "Nenhum Registro Encontrado";
                                }

                                foreach ($resultado as $r){
                                    echo "<option value=". $r->id_subfunction." selected>".$r->str_name_subfunction."</option>";
                                }

                                
                                ?>
                                </select>
                                Programa:
                            <select name="programa">
                                <?php

                                $query = "SELECT * FROM tb_program";
                                $statement = $pdo->prepare($query);

                                if ($statement->execute()){
                                    $resultado = $statement->fetchAll(PDO::FETCH_OBJ);
                                } else{
                                    echo "Nenhum Registro Encontrado";
                                }

                                foreach ($resultado as $r){
                                    echo "<option value=". $r->id_program ." selected>".$r->str_name_program."</option>";
                                }


                                
                                ?>
                                </select>
                                Ação:
                            <select name="acao">
                                <?php

                                $query = "SELECT * FROM tb_action";
                                $statement = $pdo->prepare($query);

                                if ($statement->execute()){
                                    $resultado = $statement->fetchAll(PDO::FETCH_OBJ);
                                } else{
                                    echo "Nenhum Registro Encontrado";
                                }
                                
                                foreach ($resultado as $r){
                                    echo "<option value=". $r->id_action ." selected>".$r->str_name_action."</option>";
                                }


                                
                                ?>
                                </select>
                                Beneficiário:
                            <select name="beneficiario">
                                <?php

                                $query = "SELECT * FROM tb_beneficiaries";
                                $statement = $pdo->prepare($query);

                                if ($statement->execute()){
                                    $resultado = $statement->fetchAll(PDO::FETCH_OBJ);
                                } else{
                                    echo "Nenhum Registro Encontrado";
                                }

                                foreach ($resultado as $r){
                                    echo "<option value=". $r->id_beneficiaries ." selected>".$r->str_name_person."</option>";
                                }

                                
                                ?>
                                </select>
                                Fonte:
                            <select name="fonte">
                                <?php

                                $query = "SELECT * FROM tb_source";
                                $statement = $pdo->prepare($query);

                                if ($statement->execute()){
                                    $resultado = $statement->fetchAll(PDO::FETCH_OBJ);
                                } else{
                                    echo "Nenhum Registro Encontrado";
                                }

                                foreach ($resultado as $r){
                                    echo "<option value=". $r->id_source ." selected>".$r->str_goal."</option>";
                                }

                                
                                ?>
                                </select>
                                Arquivo:
                            <select name="arquivo">
                                <?php

                                $query = "SELECT * FROM tb_files";
                                $statement = $pdo->prepare($query);

                                if ($statement->execute()){
                                    $resultado = $statement->fetchAll(PDO::FETCH_OBJ);
                                } else{
                                    echo "Nenhum Registro Encontrado";
                                }
                                
                                foreach ($resultado as $r){
                                    echo "<option value=". $r->id_file ." selected>".$r->str_name_file."</option>";
                                }

                                
                                ?>
                                </select>
                                Mês:
                                <input type="number" name="mes" value="<?php
                                echo (isset($mes) && ($mes != null || $mes != "")) ? $mes : '';
                                ?>"/>
                                Ano:
                                <input type="number" name="year" value="<?php
                                echo (isset($year) && ($year != null || $year != "")) ? $year : '';
                                ?>"/>
                                Valor:
                                <input type="number" name="valor" value="<?php
                                echo (isset($valor) && ($valor != null || $valor != "")) ? $valor : '';
                                ?>"/>


                            <input type="submit" VALUE="Cadastrar"/>
                            <hr>
                        </form>


                        <?php

                        echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';

                        //chamada a paginação
                        $object->tabelapaginada();

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <?php

        $template->footer();

        ?>

