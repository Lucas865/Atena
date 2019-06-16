<?php
include '../Controler/MateriaDAO.php';
include '../Controler/QuestoesDAO.php'; 
include '../Controler/AssuntoDAO.php'; 
session_start();
$materias_obj = new MateriaDAO;
$assunto_obj = new AssuntoDAO;
$materias = $materias_obj->listarTodos();
$materia_cod = isset($_POST['materia_cod'])?$_POST['materia_cod']:"";
$sair = isset($_POST['btn_sair_confirm'])?$_POST['btn_sair_confirm']:"";
$admin = isset($_SESSION['nivel_acesso'])?$_SESSION['nivel_acesso']:"";
if(!empty($sair) or !isset($_SESSION['usuario'])){
	unset($_SESSION['usuario']);
	session_destroy();
	echo('<script>location.href="../index.php"</script>'); 
}
if (!empty($materia_cod)) {
	$_SESSION['materia_cod'] = $materia_cod;
	echo('<script>location.href="";</script>');
}
$materia_nome  = $materias_obj->carregar($_SESSION['materia_cod']);
$_SESSION['materia_nome'] = $materia_nome;
$assuntos_materia= $assunto_obj->carregar($_SESSION['materia_cod']);
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
				<?php if(!empty($admin) and $admin = true){

					?>
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
				<?php }?>
				<!-- Nav Item - Pages Collapse Menu -->
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

							<!-- Topbar Search -->

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
								<h1 class="h3 mb-0 text-gray-800"><?=$materia_nome[0]['nome']?></h1>

							</div>

							<!-- Content Row -->
							<form method="POST" action="download.php">							
								<div class="container-fluid">

									<div class="row">
										<div class="col-xl-6 col-md-6 mb-6">
											<h5>Assuntos</h5>
											<ul class="list-group list-group-flush ">
												<div class="custom-control custom-checkbox">
													<?php
													foreach ($assuntos_materia as $assunto_materia) {

														echo('<li class="list-group-item" style="background-color: transparent;">');
														echo('<input type="checkbox" class="custom-control-input" value="');
														echo($assunto_materia['cod'] . 	'"name="' . "conteudo[]" );
														echo('"id="');
														echo($assunto_materia['nome'] .'">');
														echo('<label class="custom-control-label" for=');
														echo('"' . $assunto_materia["nome"] .'">'  .$assunto_materia["nome"] ."</label>");
														echo("</li>");}
														?>

													</ul>

												</div>
												<div class="col-xl-6 col-md-6 mb-6">
													Titulo:
													<br>
													<input type="text" class="form-control" required="required" name="titulo">

												</div>
												<div style="float: left; margin-right: 55%; margin-bottom: -4%;">
													<center>
														<h5>Quantidade de questões</h5>
														<div class="custom-control custom-radio custom-control-inline">
															<input type="radio" id="questoes1" value="5" name="questoes" class="custom-control-input">
															<label class="custom-control-label" for="questoes1">5 Questões</label>
														</div>
														<div class="custom-control custom-radio custom-control-inline">
															<input type="radio" id="questoes2" value="10" name="questoes" class="custom-control-input">
															<label class="custom-control-label" for="questoes2">10 Questões</label>
														</div>
														<div class="custom-control custom-radio custom-control-inline">
															<input type="radio" value="15" id="questoes3" name="questoes" class="custom-control-input">
															<label class="custom-control-label" for="questoes3">15 Questões</label>
														</div>
														<div class="custom-control custom-radio custom-control-inline">
															<input type="radio" value="20" id="questoes4" name="questoes" class="custom-control-input">
															<label class="custom-control-label" for="questoes4">20 Questões</label>
														</div>
													</center>
												</div>

											</div>
										</div>
										<br>
										<br>

										<br>
										<center>
											<button id="btn_user" href="#" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "><i class="fas fa-download fa-sm text-white-50 " ></i> Gerar Prova</button>
										</center>
										<!-- Content Row -->

										<div class="row">

											<div class="col-lg-6 mb-4">


											</div>
										</div>

									</div>
								</form>

								<!-- /.container-fluid -->

							</div>
							<!-- End of Main Content -->

							<!-- Footer -->
							<footer class="sticky-footer" >
								<div class="container my-auto">
									<div class="copyright text-center my-auto">
										<span>Copyright &copy; Atena System 2019</span>
									</div>
								</div>
							</footer>
							<!-- End of Footer -->

						</div>
						<!-- End of Content Wrapper -->

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

					<!-- Bootstrap core JavaScript-->
					<script src="vendor/jquery/jquery.min.js"></script>
					<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
					<script type="text/javascript">
						function f(cod) {
							var materia_cod = cod;
							$("#materia_cod").val(materia_cod);
							$("#form_materia").submit();
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
					<script src="js/loading.js"></script>
					<script src="js/xhttp.js"></script>


				</body>

				</html>
