<?php

require_once "classes/template.php";
require_once "db/beneficiarioDAO.php";

$template = new Template();

$template->header();

$template->sidebar();

$template->mainpanel();

$object = new beneficiarioDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $nis = (isset($_POST["nis"]) && $_POST["nis"] != null) ? $_POST["nis"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nis = NULL;
    $nome = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $acao = new beneficiario($id, '', '');

    $resultado = $object->atualizar($acao);
    $nis = $resultado->getNis();
    $nome = $resultado->getNomeBeneficiario();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "" && $nis != "") {
    $acao = new beneficiario($id,   $nis, $nome);
    $msg = $object->salvar($acao);
    $id = null;
    $nis = null;
    $nome = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $acao = new beneficiario($id, '', '');
    $msg = $object->remover($acao);
    $id = null;
}

?>
<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Beneficiarios</h4>
                        <p class='category'>Lista de Beneficiarios do sistema</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save&id=" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Nome:
                            <input type="text" size="50" name="nome" value="<?php
                            echo (isset($nome) && ($nome != null || $nome != "")) ? $nome : '';
                            ?>"/>
                            Nis:
                            <input type="text" size="7" name="nis" value="<?php
                            echo (isset($nis) && ($nis != null || $nis != "")) ? $nis : '';
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

