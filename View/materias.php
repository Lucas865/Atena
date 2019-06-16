<?php
include '../Controler/MateriaDAO.php';
include '../Controler/AssuntoDAO.php';  
include '../Model/Assunto.php';
session_start();
$materias_obj = new MateriaDAO;
$assunto_obj = new AssuntoDAO;
$materias = $materias_obj->listarTodos();
$materia_cod = isset($_POST['materia_cod'])?$_POST['materia_cod']:"";
$sair = isset($_POST['btn_sair_confirm'])?$_POST['btn_sair_confirm']:"";
$cod_apagar = isset($_POST['apagar_cod'])?$_POST['apagar_cod']:"";
$inpt_q = isset($_POST['inpt_q'])?$_POST['inpt_q']:"";
$inp_assunto = isset($_POST['inp_assunto'])?$_POST['inp_assunto']:"";
$cod_assunto = isset($_POST['inp_assunto_cod'])?$_POST['inp_assunto_cod']:"";
$editar = isset($_POST['editar'])?$_POST['editar']:"";
$redirecionar = isset($_POST['redirecionar'])?$_POST['redirecionar']:"";

//////////////////////Adicionar Assunto a Materia //////////////////////////////

if(!empty($cod_apagar)){
	$assunto_obj->deletar($cod_apagar);
}

if(!empty($inp_assunto)){
	$assunto = new Assunto;
	$assunto->setFk_materias_cod($cod_assunto);
	$assunto->setNome($inp_assunto);
	if ($editar == 1 and !empty($cod_assunto)) {
		$assunto->setCod($cod_assunto);
		$assunto_obj->atualizar($assunto);
	}else{
		$assunto_obj->inserir($assunto);
	}
}
/// Sair 
if(!empty($sair) or !isset($_SESSION['usuario']) or !$_SESSION['nivel_acesso']){
	unset($_SESSION['usuario']);
	session_destroy();
	echo('<script>location.href="../index.php"</script>'); 
}
if (!empty($materia_cod)) {
	$_SESSION['materia_cod'] = $materia_cod;
	echo('<script>location.href="gerar_provas.php";</script>');
}if(!empty($inpt_q)){
	$_SESSION['assunto_cod'] = $inpt_q ;
	unset($_SESSION['cod_ed']);
	unset($_SESSION['item']['a']);
	unset($_SESSION['item']['b']);
	unset($_SESSION['item']['c']);
	unset($_SESSION['item']['d']);
	unset($_SESSION['item']['e']);	
	unset($_SESSION['comando_ed']);
	unset($_SESSION['corpo_ed']);		
	unset($_SESSION['imagem_ed']);	
	echo('<script>location.href="questoes.php";</script>');
}
if (!empty($redirecionar)) {
	$_SESSION['assunto_cod'] = $redirecionar ;
	echo('<script>location.href="verquestoes.php";</script>');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Atena System</title>

	<!-- Custom fonts for this template-->
	<link rel="icon" type="image/png" href="img/logo.png" />
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="main.php">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-book-reader"></i>
				</div>
				<div class="sidebar-brand-text mx-3">Atena System</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="main.php">
					<i class="fas fa-globe-americas"></i>
					<span>Página Inicial</span></a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="historico.php">
						<i class="fas fa-calendar"></i>
						<span>Histórico</span></a>
					</li>
				</li>
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
						<i class="fas fa-brain"></i>
						<span>Matérias</span>
					</a>
					<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<form method="POST" id='form_materia'>
								<?php foreach ($materias as $materia) { 
									echo("<a class='collapse-item' onclick=f(");
									echo($materia['cod']);
									echo(")>");
									echo($materia['nome']);
									echo("</a>");
								}
								?>
								<input type='hidden' name='materia_cod' value="" id='materia_cod'>
							</form>
						</div>
					</div>
				</li>

				<!-- Nav Item - Pages Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages">
						<i class="fas fa-cog"></i>
						<span>Configurações</span>
					</a>
					<div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class='collapse-item' href="materias.php"> Matérias </a>
						</div>
					</div>
				</li>


				<!-- Nav Item - Tables -->
				<li class="nav-item">
					<a class="nav-link" id="btn_sair" href="#"><i class="fas fa-sign-out-alt"></i>
						<span>Sair</span></a>
					</li>

					<!-- Divider -->
					<hr class="sidebar-divider d-none d-md-block">

					<!-- Sidebar Toggler (Sidebar) -->
					<div class="text-center d-none d-md-inline">
						<button class="rounded-circle border-0" id="sidebarToggle"></button>
					</div>

				</ul>
				<!-- End of Sidebar -->

				<!-- Content Wrapper -->
				<div id="content-wrapper" class="d-flex flex-column">

					<!-- Main Content -->
					<div id="content">

						<!-- Topbar -->
						<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

							<!-- Sidebar Toggle (Topbar) -->
							<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
								<i class="fa fa-bars"></i>
							</button>


							<!-- Topbar Navbar -->
							<ul class="navbar-nav ml-auto">

								<!-- Nav Item - Search Dropdown (Visible Only XS) -->

								<!-- Nav Item - User Information -->
								<li class="nav-item dropdown no-arrow">
									<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo($_SESSION['usuario']['user']);?></span>
										<img class="img-profile rounded-circle" src="img/profile.png">
									</a>
									<!-- Dropdown - User Information -->

								</li>

							</ul>

						</nav>
						<!-- End of Topbar -->

						<!-- Begin Page Content -->
						<div class="container-fluid">

							<!-- Page Heading -->
							<div class="d-sm-flex align-items-center justify-content-between mb-4">
								<h1 class="h3 mb-0 text-gray-800">Matérias</h1>

							</div>
						</div>

						<!-- Content Row -->

						<div class="container-fluid">


							<?php
							foreach ($materias as $materia) {
								$assuntos = $assunto_obj->carregar($materia['cod']);
								echo("<table class='table '>");
								echo("<thead>");
								echo("<h5>".$materia['nome']."  <button type='button' onclick='H(".$materia['cod'] .")'class='btn btn-info btn-sm '><i class='fas fa-plus'></i></button>");
								echo("<tr>");
								echo("<th width='75%'; scope='col'>Assunto</th>");
								echo("<th scope='col'>Visualizar</th>");
								echo("<th scope='col'>Adicionar</th>");
								echo("<th scope='col'>Editar</th>");
								echo("<th scope='col'>Apagar</th>");
								echo("</tr>");
								echo("</thead>");
								echo("<tbody>");

								foreach ($assuntos as $assunto) {
									echo("<tr>");
									echo("<td scope='row'>".$assunto['nome']."</td>");
									echo("<td><button type='button' onclick='S(".$assunto['cod'].")' class='btn btn-info'><i class='fas fa-eye'></i></button></td>");
									echo('<td><form method="POST" id="form_p"> <button type="button" onclick="G('.$assunto['cod'].')" value="'.$assunto['cod'].'" class="btn btn-info " style="margin-left:1px;"><i class="far fa-clipboard"></i></button></h5><input type="hidden" name="inpt_q" id="inpt_q" value=""> </td>');
									echo("<td><button type='button' onclick='A(".$assunto['cod'].','.'"'.$assunto['nome'].'"'.")' class='btn btn-success'><i class='fas fa-edit'></i></button></td>");
									echo("<td><button type='button' onclick='P(".$assunto['cod'].")' class='btn btn-danger'><i class='fas fa-trash-alt'></i></button></td>");
									echo("<input type='hidden' id='apagar_cod' name='apagar_cod' value=''>");
									echo("<input type='hidden' name='redirecionar' id='redirecionar'>
										</form>");
									echo("</tr>");
								}
								echo("</tbody>");
								echo("</table>");
							}


							?>



							<!-- /.container-fluid -->
						</div>
						<!-- End of Main Content -->

						<!-- Footer -->

						<!-- End of Footer -->
					</div>

					<!-- Footer -->
					<footer class="sticky-footer">
						<div class="container my-auto">
							<div class="copyright text-center my-auto">
								<span>Copyright &copy; Atena System 2019</span>
							</div>
						</div>
					</footer>
					<!-- End of Footer -->

				</div>
				<!-- End of Page Wrapper -->

				<!-- Scroll to Top Button-->
				<a class="scroll-to-top rounded" href="#page-top">
					<i class="fas fa-angle-up"></i>
				</a>

				<!-- Logout Modal-->
				<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Logout</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">Deseja Sair? <form id="form_sair" method="POST"></div>
								<div class="modal-footer">
									<input type="hidden" name="inp_sair" id="inp_sair">
									<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
									<button class="btn btn-primary" name="btn_sair_confirm" id="btn_sair_confirm">Sair</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- ADD Modal-->
				<div class="modal fade" id="AddAssuntoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" ><p id="tmodal"></p></h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">Nome:<form id="form_add_assunto" method="POST">
								<input type="text" name="inp_assunto" id="inp_assunto">
							</div>
							<div class="modal-footer">
								<input type="hidden" name="inp_assunto_cod" id="inp_assunto_cod">
								<input type="hidden" name="editar" id="editar">
								<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
								<button class="btn btn-primary" name="btn_add_assunto_confirm" id="btn_add_assunto_confirm">Confirmar</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Bootstrap core JavaScript-->
			<script src="vendor/jquery/jquery.min.js"></script>
			<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
			<script type="text/javascript">
				function f(cod) {
					var materia_cod = cod;
					$("#materia_cod").val(materia_cod);
					$("#form_materia").submit();
				}
				function G(cod) {
					var cod = cod;
					$('#inpt_q').val(cod);
					$("#form_p").submit();

				}	
				function P(cod) {
					var cod = cod;
					$('#apagar_cod').val(cod);
					$("#form_p").submit();

				}
				function A(cod,nome) {
					var cod = cod;
					var nome = nome;
					$('#tmodal').html('Editar');
					$('#inp_assunto').val(nome);
					$("#AddAssuntoModal").modal('show');
					$("#btn_add_assunto_confirm").click(function(){
						$("#editar").val(1);
						$("#inp_assunto_cod").val(cod);
					});
				}
				function H(cod) {
					var cod = cod;
					$('#tmodal').html('Cadastrar');
					$("#AddAssuntoModal").modal('show');
					$("#btn_add_assunto_confirm").click(function(){
						$("#inp_assunto_cod").val(cod);
					});
				}

				function S(cod) {
					var cod = cod;
					$("#redirecionar").val(cod);
					$("#form_p").submit();
				}
				$("#btn_sair").click(function(){
					$("#logoutModal").modal('show');
					$("#btn_sair_confirm").click(function(){
						$("#btn_sair_confirm").val(1);
					});
				});
			</script>
			<!-- Core plugin JavaScript-->
			<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

			<!-- Custom scripts for all pages-->
			<script src="js/sb-admin-2.min.js"></script>

		</body>

		</html>
