<?php
/**
 * Created by PhpStorm.
 * User: Jimmy
 * Date: 07/06/2018
 * Time: 18:26
 */

//So funciona se desativar os erros!
ini_set('display_errors', 0);

require_once "../mpdf/mpdf.php";
require_once "../../../db/relatorioDAO.php";

$dao = new relatorioDAO();
$listObjs = $dao->rela3();
$data = $dao ->dataAtual();
$hr = $dao ->horaAtual();
$html = "<p>Data/Hora Base: $data - $hr</p>";
$html .= "<table border='1' cellspacing='0' cellpadding='2' bordercolor='666633'>";
$html .= "<tr>
            <th colspan='9' align='center'>PAGAMENTOS</th>
        </tr>";
$html .= "<tr>
            <th>ID PAGAMENTO</th>
            <th>CIDADE</th>
            <th>FUNÇÃO</th>
            <th>SUBFUNÇÃO</th>
            <th>PROGRAMA</th>
            <th>AÇÃO</th>
            <th>BENEFICIARIOS</th>
            <th>NIS</th>
            <th>ARQUIVO</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->id_payment</td>
                <td>$var->str_name_city</td>
                <td>$var->str_name_function</td>
                <td>$var->str_name_subfunction</td>
                <td>$var->str_name_program</td>
                <td>$var->str_name_action</td>
                <td>$var->str_name_person</td>
                <td>$var->str_goal</td>
                <td>$var->str_name_file</td>
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