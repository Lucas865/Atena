<?php
function GerarPDF($titulo,$qtd_questoes,$check_assuntos,$cod_user){
	include '../Controler/QuestoesDAO.php'; 
	include '../Controler/ProvaQuestoesDAO.php'; 
	include '../Model/ProvaQuestoes.php'; 
	include '../Model/Prova.php'; 
	include '../Controler/ProvaDAO.php'; 
	unset($_SESSION['prova_cod']);
	$provaQ_obj = new ProvaQuestoesDAO();
	$provaQ = new ProvaQuestoes();
	$prova_obj = new ProvaDAO();
	$prova = new Prova();
	$prova->setData(date("d/m/Y"));
	$prova->setFk_user_cod($cod_user);
	$prova->setTitulo($titulo);
	$prova_obj->inserir($prova);
	$prova_user_cod = $prova_obj->listar($cod_user);
	$prova_cod = $prova_user_cod[0]['cod']  ;
	$questoes_obj = new QuestoesDAO;
	$header = 
	'<!DOCTYPE html>
	<html lang="pt-br">
	<head>
	<meta charset="utf-8">
	<link href="css/pdf.css" rel="stylesheet">
	</head>
	<body>
	<img src="img/logo.png" id="logo">' . '
	<h3 style="text-align:center">
	'.$titulo.'
	</h3>';
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
	while ( $i < $qtd_questoes ) { 
		shuffle($check_assuntos);
		$questoes =  $questoes_obj->carregar($check_assuntos[0]);
		shuffle($questoes);	
		foreach ($questoes as $questao) {
			if (!in_array($questao,$questoes_prova)) {
				$i += 1;
				array_push($questoes_prova, $questao);
				$html .=  "<h5>$i</h5>".$questao['corpo']."<br>";
				if (!empty($questao['imagem'])) {
					$html .= "<img src='" .$questao['imagem']."'/>" . "<br>";
				}
				$html .= $questao['comando']."<br>";
				$html .= "a)".$questao['item_a']."<br>";
				$html .= "b)".$questao['item_b']."<br>";
				$html .= "c)".$questao['item_c']."<br>";
				$html .= "d)".$questao['item_d']."<br>";
				$html .= "e)".$questao['item_e']."<br>";
				$provaQ->setFk_questoes_cod($questao['cod']);
				$provaQ->setFk_prova_cod($prova_cod);
				$provaQ_obj->inserir($provaQ); 
				break;
			}
		}
	}

	$i = 1;
	$html .= '<br> <table class="table-sm  table-striped table-bordered">
	<thead class="table-dark">
	<tr>
	<th scope="col" colspan = 6>Gabarito</th>
	</tr>
	</thead>
	<tbody>';
	while($i < $qtd_questoes+1){
		$html .= " <tr><th scope='row'>$i</th><td>A</td><td>B</td><td>C</td><td>D</td><td>E</td></tr>";
		$i++;
	}
	$html .= "</tbody></table>";
	return $pdf =  $header.$html.$body_end;
}
?>