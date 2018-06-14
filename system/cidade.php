<?php

require_once "classes/template.php";
require_once "db/cidadeDAO.php";

$template = new Template();

$template->header();

$template->sidebar();

$template->mainpanel();

$object = new cidadeDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $codigo = (isset($_POST["codigo"]) && $_POST["codigo"] != null) ? $_POST["codigo"] : "";
    $estado = (isset($_POST["estado"]) && $_POST["estado"] != null) ? $_POST["estado"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $codigo = NULL;
    $estado = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $cidade = new cidade($id, '', '','');

    $resultado = $object->atualizar($cidade);
    $nome = $resultado->getNome();
    $codigo = $resultado->getCodigo();
    $estado = $resultado->getIdEstado();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "" && $codigo != ""&& $estado != "") {
    $cidade = new cidade($id, $nome,  $codigo, $estado);
    $msg = $object->salvar($cidade);
    $id = null;
    $nome = null;
    $codigo = null;
    $estado = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $cidade = new cidade($id, '', '','');
    $msg = $object->remover($cidade);
    $id = null;
}

?>
<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Cidades</h4>
                        <p class='category'>Lista de Cidades do sistema</p>

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
                            Codigo:
                            <input type="text" size="7" name="codigo" value="<?php
                            echo (isset($codigo) && ($codigo != null || $codigo != "")) ? $codigo : '';
                            ?>"/>
                            Estado:
                            <select name="estado">
                                <?php

                                $query = "SELECT * FROM tb_state";

                                foreach ($pdo->query($query) as $value) {
                                    $resultado[] = $value;
                                }

                                if(isset($resultado)) {
                                    foreach ($resultado as $r){
                                        echo "<option value=$r[id_state]>$r[str_name]</option>";
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

