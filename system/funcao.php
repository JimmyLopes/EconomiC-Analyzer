<?php

require_once "classes/template.php";
require_once "db/funcaoDAO.php";

$template = new Template();

$template->header();

$template->sidebar();

$template->mainpanel();

$object = new funcaoDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $codigo = (isset($_POST["codigo"]) && $_POST["codigo"] != null) ? $_POST["codigo"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $codigo = NULL;
    $nome = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $funcao = new funcao($id, '', '');

    $resultado = $object->atualizar($funcao);
    $codigo = $resultado->getCodFuncao();
    $nome = $resultado->getNomeFuncao();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "" && $codigo != "") {
    $funcao = new funcao($id,   $codigo, $nome);
    $msg = $object->salvar($funcao);
    $id = null;
    $codigo = null;
    $nome = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $funcao = new funcao($id, '', '');
    $msg = $object->remover($funcao);
    $id = null;
}

?>
<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Funções</h4>
                        <p class='category'>Lista de Funções do sistema</p>

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
                            Codigo:
                            <input type="text" size="7" name="codigo" value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($codigo) && ($codigo != null || $codigo != "")) ? $codigo : '';
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

