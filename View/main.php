<?php  
include '../Controler/MateriaDAO.php';
include '../Controler/ProvaDAO.php';
session_start();
$materias = new MateriaDAO;
$provas = new ProvaDAO;
$provas = $provas->listar($_SESSION['usuario']['cod']); 
$materias = $materias->listarTodos();
$materia_cod = isset($_POST['materia_cod'])?$_POST['materia_cod']:"";
$prova_cod = isset($_POST['prova_cod'])?$_POST['prova_cod']:"";
$sair = isset($_POST['btn_sair_confirm'])?$_POST['btn_sair_confirm']:"";
$admin = isset($_SESSION['nivel_acesso'])?$_SESSION['nivel_acesso']:"";
if (!empty($materia_cod)) {
  $_SESSION['materia_cod'] = $materia_cod;
  echo('<script>location.href="gerar_provas.php"</script>');
}
if (!empty($prova_cod)) {
  $_SESSION['prova_cod'] = $prova_cod;
  echo('<script>location.href="verquestoes.php"</script>');
}
if(!empty($sair) or !isset($_SESSION['usuario'])){
  unset($_SESSION['usuario']);
  session_destroy();
  echo('<script>location.href="../index.php"</script>'); 
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
      <a class="nav-link" href="#" id="btn_sair"><i class="fas fa-sign-out-alt"></i>
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
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php echo($_SESSION['usuario']['user']);?>
                </span>
                <img class="img-profile rounded-circle" src="img/profile.png">
              </a>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Início</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" style="margin-left: 40%;">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body" >
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Facíl</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Prático e Simples</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" >
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Grande Número de Questões</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">+300 Questões de Vestibulares</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" style="margin-left: 40%;">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Seguro</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Dados Criptografados</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-lock fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Rápido</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Não te deixa na mão</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-stopwatch fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->


            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-4" >
              <div>
                <!-- Card Header - Dropdown -->
                <div  style="margin-top: -85%;">

                  <!-- Card Body -->
                  <div >
                    <div class="mt-4 text-center" >
                      <div class="text-center" >
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem; " src="img/undraw_professor_8lrt.svg" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content Row -->
            <div class="row">

              <!-- Content Column -->





            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

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
    function t(cod) {
      var prova_cod = cod;
      $("#prova_cod").val(prova_cod);
      $("#form_prova").submit();
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
