<?php
include '../Controler/MateriaDAO.php';
include '../Controler/ProvaDAO.php';
include '../Model/Prova.php';
session_start();
///////////// OBJETOS ////////////////
$materias_obj = new MateriaDAO;
$materias = $materias_obj->listarTodos();
$prova_obj = new ProvaDAO();
$provas = $prova_obj->listar($_SESSION['usuario']['cod']);
////////////////////////////////////////////////////
$cod_apagar = isset($_POST['apagar_cod'])?$_POST['apagar_cod']:"";
$refazer_cod = isset($_POST['refazer_cod'])?$_POST['refazer_cod']:"";
$prova_titulo = isset($_POST['prova_titulo'])?$_POST['prova_titulo']:"";
$materia_cod = isset($_POST['materia_cod'])?$_POST['materia_cod']:"";
$sair = isset($_POST['btn_sair_confirm'])?$_POST['btn_sair_confirm']:"";
$admin = isset($_SESSION['nivel_acesso'])?$_SESSION['nivel_acesso']:"";
/////////////////////Questão//////////////////////////////
if(!empty($sair) or !isset($_SESSION['usuario'])){
  unset($_SESSION['usuario']);
  session_destroy();
  echo('<script>location.href="../index.php"</script>'); 
}
if (!empty($materia_cod)) {
  $_SESSION['materia_cod'] = $materia_cod;
  echo('<script>location.href="gerar_provas.php";</script>');
}
if(!empty($refazer_cod)){
  $_SESSION['prova_cod'] = $refazer_cod;
  $_SESSION['prova_titulo'] = $prova_titulo;
  echo('<script>location.href="download_prova.php";</script>');
}
if(!empty($cod_apagar)){
  if($prova_obj->deletar($cod_apagar)){
    echo('<script>location.href="historico.php";</script>');
  }
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

  <style type="text/css">
    input[type='file'] {
      display: none
    }
    #label {
      background-color: #3498db;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
    }
    .input-wrapper #label {
      background-color: #3498db;
      border-radius: 5px;
      color: #fff;
      margin-top: 10px;
      padding: 6px 20px
    }
    .input-wrapper #label:hover {
      background-color: #2980b9
    }
  </style>

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
                <h1 class="h3 mb-0 text-gray-800">Histórico</h1>

              </div>

              <center>
                <!-- Content Row -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">                    
                  <table class='table '>
                    <thead>
                      <tr>
                        <th width='75%'; scope='col'>Nome</th>
                        <th scope='col'>Data</th>
                        <th scope='col'>Refazer</th>
                        <th scope='col'>Apagar</th>
                      </tr>
                    </thead>
                    <tbody> 
                      <?php foreach ($provas as $x) {
                        echo("<tr> <form method='POST' id='form_p'>");
                        echo("<td scope='row'>".$x['nome']."</td>");
                        echo("<td scope='row'>".$x['data']."</td>");
                        echo("<td><button type='button' onclick=\"A(".$x['cod'].','."'".$x['nome']."'".")\""." class='btn btn-primary'><i class='fas fa-redo'></i></button></td>");
                        echo("<td><button type='button' onclick='P(".$x['cod'].")' class='btn btn-danger'><i class='fas fa-trash-alt'></i></button></td>");
                        echo("</tr>");
                      }
                      ?>
                      <input type='hidden' id='apagar_cod' name='apagar_cod' value=''>
                      <input type='hidden' id='refazer_cod' name='refazer_cod' value=''>
                      <input type='hidden' id='prova_titulo' name='prova_titulo' value=''>
                    </form>
                  </tbody>                        </table>
                </div>
                <!-- /.container-fluid -->

              </div>
              <!-- End of Main Content -->

              <!-- Footer -->

              <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->
            <footer class="sticky-footer ">
              <div class="container my-auto">
                <div class="copyright text-center my-auto">
                  <span>Copyright &copy; Atena System 2019</span>
                </div>
              </div>
            </footer>
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
            function P(cod) {
              var cod = cod;
              $('#apagar_cod').val(cod);
              $("#form_p").submit();
            }
            function A(cod,titulo) {
              var cod = cod;
              var titulo = titulo;
              $('#refazer_cod').val(cod);
              $('#prova_titulo').val(titulo);
              $("#form_p").submit();
            }
          </script>
          <!-- Core plugin JavaScript-->
          <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

          <!-- Custom scripts for all pages-->
          <script src="js/sb-admin-2.min.js"></script>


        </body>

        </html>
