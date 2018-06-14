<?php
/**
* Created by PhpStorm.
* User: Jimmy
* Date: 07/06/2018
* Time: 18:28
*/

//So funciona se desativar os erros!
ini_set('display_errors', 0);

require_once "../mpdf/mpdf.php";
require_once "../../../db/relatorioDAO.php";

$dao = new relatorioDAO();
$listObjs = $dao->rela4();
$data = $dao ->dataAtual();
$hr = $dao ->horaAtual();
$html = "<p>Data/Hora Base: $data - $hr</p>";
$html .= "<table border='1' cellspacing='0' cellpadding='2' bordercolor='666633'>";
$html .= "<tr>
            <th colspan='3' align='center'>QUANTIDADE DE BENEFICIÁRIOS E VALOR PAGO POR CIDADE</th>
        </tr>";
$html .= "<tr>
            <th>TOTAL PAGO</th>
            <th>CIDADE</th>
            <th>QUANTIDADE BENEFICIARIOS</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->soma</td>
                <td>$var->str_name_city</td>
                <td>$var->contador</td>
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