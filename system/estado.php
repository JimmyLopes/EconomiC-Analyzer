<?php

require_once "classes/template.php";
require_once "db/estadoDAO.php";

$template = new Template();

$template->header();

$template->sidebar();

$template->mainpanel();

$object = new estadoDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $uf = (isset($_POST["uf"]) && $_POST["uf"] != null) ? $_POST["uf"] : "";
    $regiao = (isset($_POST["regiao"]) && $_POST["regiao"] != null) ? $_POST["regiao"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $uf = NULL;
    $regiao = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $estado = new estado($id, '', '','');

    $resultado = $object->atualizar($estado);
    $uf = $resultado->getUF();
    $nome = $resultado->getNomeEstado();
    $regiao = $resultado->getIdRegiao();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "" && $uf != ""&& $regiao != "") {
    $estado = new estado($id, $uf,  $nome, $regiao);
    $msg = $object->salvar($estado);
    $id = null;
    $nome = null;
    $uf = null;
    $regiao = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $estado = new estado($id, '', '','');
    $msg = $object->remover($estado);
    $id = null;
}

?>
<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Estados</h4>
                        <p class='category'>Lista de Estados do sistema</p>

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
                            UF:
                            <input type="text" size="7" name="uf" value="<?php
                            echo (isset($uf) && ($uf != null || $uf != "")) ? $uf : '';
                            ?>"/>
                            Regiao:
                            <select name="regiao">
                                <?php

                                $query = "SELECT * FROM tb_region";

                                foreach ($pdo->query($query) as $value) {
                                    $resultado[] = $value;
                                }

                                if(isset($resultado)) {
                                    foreach ($resultado as $r){
                                        echo "<option value=$r[id_region]>$r[str_name_region]</option>";
                                    }
                                } else {
                                    echo "Nenhum Registro Encontrado";
                                }

                                ?>
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

