<?php
function GerarPDF($titulo,$qtd_questoes,$check_assuntos,$cod_user,$prova_salva){
	include '../Controler/QuestoesDAO.php'; 
	include '../Controler/ProvaQuestoesDAO.php'; 
	include '../Model/ProvaQuestoes.php'; 
	include '../Model/Prova.php'; 
	include '../Controler/ProvaDAO.php'; 
	$prova_salva = isset($prova_salva)?$prova_salva:"";
	$provaQ_obj = new ProvaQuestoesDAO();
	$provaQ = new ProvaQuestoes();
	$prova_obj = new ProvaDAO();
	$prova = new Prova();
	$prova_user_cod = $prova_obj->listar($cod_user);
	$prova_cod = $prova_user_cod[0]['cod']  ;
	$questoes_obj = new QuestoesDAO;
	if (!empty($prova_salva)) {
		$fazer = true;
	}
	$header = 
	'<!DOCTYPE html>
	<html lang="pt-br">
	<head>
	<meta charset="utf-8">
	<link href="css/pdf.css" rel="stylesheet">
	</head>
	<body>
	<img src="img/logo.png" id="logo">' . '
	<h1 style="text-align:center">
	'.$titulo.'
	</h1>';
	$body_end = 
	'</div>
	<footer class="sticky-footer bg-white">
	<div class="container my-auto">
	<div class="copyright text-center my-auto">
	<span>Copyright &copy; Atena System 2019</span>
	</div>
	</div>
	</footer>
	</body>';
	$i = 0;
	$html = "";
	$questoes_prova = array();
	if ($fazer) {
		$questoes_prova =  $provaQ_obj->carregar($prova_salva);
		foreach ($questoes_prova as $p ) {
			$questoes =  $questoes_obj->carregarQ($p['fk_questoes_cod']);
			foreach ($questoes as $questao) {
				$i += 1;
				$html .=  "<h3>$i</h3>".$questao['corpo']."<br>";
				if (!empty($questao['imagem'])) {
					$html .= "<img src='" .$questao['imagem']."'/>" . "<br>";
				}
				$html .= $questao['comando']."<br>";
				$html .= "a)".$questao['item_a']."<br>";
				$html .= "b)".$questao['item_b']."<br>";
				$html .= "c)".$questao['item_c']."<br>";
				$html .= "d)".$questao['item_d']."<br>";
				$html .= "e)".$questao['item_e']."<br>";
			}
		}
		
	}
	$t = 1;
	$html .= '<br> <table class="table-sm  table-striped table-bordered">
	<thead class="table-dark">
	<tr>
	<th scope="col" colspan = 6>Gabarito</th>
	</tr>
	</thead>
	<tbody>';
	while($t < $i+1){
		$html .= " <tr><th scope='row'>$t</th><td>A</td><td>B</td><td>C</td><td>D</td><td>E</td></tr>";
		$t++;
	}
	$html .= "</tbody></table>";
	return $pdf =  $header.$html.$body_end;
}
?>