<?php	
use Dompdf\Dompdf;

require_once("dompdf/autoload.inc.php");
include 'funcoes_h.php';

session_start();
$qtd_questoes = isset($_POST['questoes'])?$_POST['questoes']:"";
$check_assuntos = isset($_POST['conteudo'])?$_POST['conteudo']:"";
$titulo = $_SESSION['prova_titulo'];
$dompdf = new DOMPDF();
	// Carrega seu HTML
$dompdf->load_html(GerarPDF($titulo,$qtd_questoes,$check_assuntos,$_SESSION['usuario']['cod'],$_SESSION['prova_cod']));

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
ob_end_clean();
$dompdf->stream(
	md5(random_int(1, 100)).".pdf", 
	array(
	"Attachment" =>false//Para realizar o download somente alterar para true
)
);
?>