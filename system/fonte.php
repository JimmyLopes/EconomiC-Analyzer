<?php

require_once "classes/template.php";
require_once "db/fonteDAO.php";

$template = new Template();

$template->header();

$template->sidebar();

$template->mainpanel();

$object = new fonteDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $origem = (isset($_POST["origem"]) && $_POST["origem"] != null) ? $_POST["origem"] : "";
    $goal = (isset($_POST["goal"]) && $_POST["goal"] != null) ? $_POST["goal"] : "";
    $periodicidade = (isset($_POST["periodicidade"]) && $_POST["periodicidade"] != null) ? $_POST["periodicidade"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $origem = NULL;
    $goal = NULL;
    $periodicidade = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $fonte = new fonte($id, '', '','');

    $resultado = $object->atualizar($fonte);
    $goal = $resultado->getGoal();
    $origem = $resultado->getOrigem();
    $periodicidade = $resultado->getPeriodicidade();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $origem != "" && $goal != ""&& $periodicidade != "") {
    $fonte = new fonte($id, $goal,  $origem, $periodicidade);
    $msg = $object->salvar($fonte);
    $id = null;
    $origem = null;
    $goal = null;
    $periodicidade = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $fonte = new fonte($id, '', '','');
    $msg = $object->remover($fonte);
    $id = null;
}

?>
<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Fontes</h4>
                        <p class='category'>Lista de Fontes do sistema</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save&id=" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Origem:
                            <input type="text" size="50" name="origem" value="<?php
                            echo (isset($origem) && ($origem != null || $origem != "")) ? $origem : '';
                            ?>"/>
                            Goal:
                            <input type="text" size="7" name="goal" value="<?php
                            echo (isset($goal) && ($goal != null || $goal != "")) ? $goal : '';
                            ?>"/>
                            Periodicidade:
                                <input type="text" size="7" name="periodicidade" value="<?php
                                echo (isset($periodicidade) && ($periodicidade != null || $periodicidade != "")) ? $periodicidade : '';
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

