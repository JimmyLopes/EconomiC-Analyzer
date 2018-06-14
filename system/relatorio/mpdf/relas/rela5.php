<?php
/**
* Created by PhpStorm.
* User: Jimmy
* Date: 07/06/2018
* Time: 18:29
*/

//So funciona se desativar os erros!
ini_set('display_errors', 0);

require_once "../mpdf/mpdf.php";
require_once "../../../db/relatorioDAO.php";

$dao = new relatorioDAO();
$listObjs = $dao->rela5();
$data = $dao ->dataAtual();
$hr = $dao ->horaAtual();
$html = "<p>Data/Hora Base: $data - $hr</p>";
$html .= "<table border='1' cellspacing='0' cellpadding='2' bordercolor='666633'>";
$html .= "<tr>
            <th colspan='5' align='center'>TOTAL DE PAGAMENTOS POR ESTADO</th>
        </tr>";
$html .= "<tr>
            <th>NOME</th>
            <th>QUANTIDADE DE PAGAMENTOS</th>
            <th>TOTAL PAGO</th>
            <th>MÊS</th>
            <th>ANO</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->tb_beneficiaries</td>
                <td>$var->QTD</td>
                <td>$var->SOMA</td>
                <td>$var->int_month</td>
                <td>$var->int_year</td>
          </tr>";
endforeach;
$html .= "</table>";
$mpdf = new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Jimmy');
$mpdf->SetTitle('TCPDF Beneficiários');
$mpdf->SetSubject('TCPDF Beneficiários');
$mpdf->SetKeywords('TCPDF, PDF, beneficiarios');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter('Página {PAGENO}{nbpg}');
$mpdf->WriteHTML($html);
$mpdf->Output('Exemplo.pdf', 'I');
exit;