<?php
/**
 * Created by PhpStorm.
 * User: Jimmy
 * Date: 07/06/2018
 * Time: 18:24
 */

//So funciona se desativar os erros!
ini_set('display_errors', 0);

require_once "../mpdf/mpdf.php";
require_once "../../../db/relatorioDAO.php";

$dao = new relatorioDAO();
$listObjs = $dao->rela2();
$data = $dao ->dataAtual();
$hr = $dao ->horaAtual();
$html = "<p>Data/Hora Base: $data - $hr</p>";
$html .= "<table border='1' cellspacing='0' cellpadding='2' bordercolor='666633'>";
$html .= "<tr>
            <th colspan='3' align='center'>BENEFICIÁRIOS POR CIDADE</th>
        </tr>";
$html .= "<tr>
            <th>ID</th>
            <th>NOME</th>
            <th>NIS</th>
            <th>ID CIDADE</th>
            <th>CIDADE</th>
            <th>CODIGO SIAFI</th>
            <th>ID ESTADO</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->id_beneficiaries</td>
                <td>$var->str_name_person</td>
                <td>$var->str_nis</td>
                <td>$var->id_city</td>
                <td>$var->str_name_city</td>
                <td>$var->str_cod_siafi_city</td>
                <td>$var->tb_state_id_state</td>
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