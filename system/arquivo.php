<?php

require_once "classes/template.php";
require_once "db/arquivoDAO.php";

$template = new Template();

$template->header();

$template->sidebar();

$template->mainpanel();

$object = new arquivoDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $mes = (isset($_POST["mes"]) && $_POST["mes"] != null) ? $_POST["mes"] : "";
    $ano = (isset($_POST["ano"]) && $_POST["ano"] != null) ? $_POST["ano"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $mes = NULL;
    $ano = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $arquivo = new arquivo($id, '', '','');

    $resultado = $object->atualizar($arquivo);
    $nome = $resultado->getNomeArquivo();
    $mes = $resultado->getMesArquivo();
    $ano = $resultado->getAnoArquivo();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "" && $mes != ""&& $ano != "") {
    $arquivo = new arquivo($id, $nome,  $mes, $ano);
    $msg = $object->salvar($arquivo);
    $id = null;
    $nome = null;
    $mes = null;
    $ano = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $arquivo = new arquivo($id, '', '','');
    $msg = $object->remover($arquivo);
    $id = null;
}

?>
<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Arquivos</h4>
                        <p class='category'>Lista de Arquivos do sistema</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save&id=" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Nome:
                            <input type="text" size="50" name="nome" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($nome) && ($nome != null || $nome != "")) ? $nome : '';
                            ?>"/>
                            Mes:
                            <input type="text" size="7" name="mes" value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($mes) && ($mes != null || $mes != "")) ? $mes : '';
                            ?>"/>
                            Ano:
                            <input type="text" size="7" name="ano" value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($ano) && ($ano != null || $ano != "")) ? $ano : '';
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

