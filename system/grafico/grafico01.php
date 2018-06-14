<?php

require_once "PHPlot/phplot/phplot.php";
require_once "../db/conexao.php";
require_once "../grafico/imgGrafico1.php";

#Instancia o objeto e setando o tamanho do grafico na tela
$grafico = new \PHPlot(900,300);
#Indicamos o títul do gráfico e o título dos dados no eixo X e Y do mesmo
$grafico->SetTitle(utf8_decode("Beneficiários por Mes e Ano"));
//$grafico->SetTitle("Beneficiários por Mês e Ano");
$grafico->SetXTitle(utf8_decode("Mês e Ano"));

$grafico->SetYTitle(utf8_decode("Monthly Beneficiaries"));

$query = "SELECT count(tb_beneficiaries_id_beneficiaries )as qtde, int_month as mes, int_year as ano FROM tb_payments group by int_month, int_year order by int_year asc, int_month asc;";
$statement = $pdo->prepare($query);

$statement->execute();
$rs = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($rs)) {
    foreach ($rs as $r){
        $data = array(array($r['ano'].'/'.$r['mes'], $r['qtde']));
    }
    
} else {
    $data[]=[null,null];
}

//$grafico->SetDefaultTTFont('assets/fonts/Timeless.ttf');
$grafico->SetDataValues($data);
#Neste caso, usariamos o gráfico em barras
$grafico->SetPlotType("linepoints");
#Exibimos o gráfico
//Disable image output
$grafico->SetPrintImage(true);
//Draw the graph
$grafico->DrawGraph();

$pdf = new PDF_MemImage();
$pdf->AddPage();
$pdf->GDImage($grafico->img,30,20,140);
$pdf->Output();
