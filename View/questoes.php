<?php
include '../Controler/MateriaDAO.php';
include '../Controler/QuestoesDAO.php'; 
include '../Controler/AssuntoDAO.php';
include '../Model/Questoes.php';
session_start();
///////////// OBJETOS ////////////////
$materias_obj = new MateriaDAO;
$assunto_obj = new AssuntoDAO;
$questoes_obj = new QuestoesDAO;
$materias = $materias_obj->listarTodos();
$questoes = new Questoes;
////////////////////////////////////////////////////
$materia_cod = isset($_POST['materia_cod'])?$_POST['materia_cod']:"";
$sair = isset($_POST['btn_sair_confirm'])?$_POST['btn_sair_confirm']:"";
$admin = isset($_SESSION['nivel_acesso'])?$_SESSION['nivel_acesso']:"";
/////////////////////Questão//////////////////////////////
$corpo = isset($_POST['corpo'])?$_POST['corpo']:"";
$assunto = $assunto_obj->carregarCod($_SESSION['assunto_cod']);
$foto = isset($_FILES['arquivo']['name'])?$_FILES['arquivo']['name']:"";
$item_a = isset($_POST['item_a'])?$_POST['item_a']:"";
$item_b = isset($_POST['item_b'])?$_POST['item_b']:"";
$item_c = isset($_POST['item_c'])?$_POST['item_c']:"";
$item_d = isset($_POST['item_d'])?$_POST['item_d']:"";
$item_e = isset($_POST['item_e'])?$_POST['item_e']:"";
$cod_ed = isset($_SESSION['cod_ed'])?$_SESSION['cod_ed']:"";
$imagem_ed = isset($_SESSION['imagem_ed'])?$_SESSION['imagem_ed']:"";
$comando = isset($_POST['comando'])?$_POST['comando']:"";
$submt = isset($_POST['submt'])?$_POST['submt']:"";
if (!empty($submt)) {

  if (!empty($comando)) {
    if(!empty($foto)){
      if ($_FILES['arquivo']['name'] != $imagem_ed) {
        $tipo = explode(".",$_FILES['arquivo']['name']);
        $novo_nome = sha1(microtime()).".".$tipo[1];
        move_uploaded_file($_FILES['arquivo']['tmp_name'], "img_q/".$novo_nome);
        $questoes->setImagem("img_q/".$novo_nome);
      }
      else{
        $questoes->setImagem($_SESSION['imagem_ed']);
      }

    }
    $questoes->setItem_a($item_a);
    $questoes->setItem_b($item_b);
    $questoes->setItem_c($item_c);
    $questoes->setItem_d($item_d);
    $questoes->setItem_e($item_e);
    $questoes->setCorpo($corpo);
    $questoes->setFk_assunto_cod($assunto[0]['cod']);
    $questoes->setComando($comando);
    if (!empty($cod_ed)) {
      $questoes_obj->atualizar($questoes,$_SESSION['cod_ed']);
    }
    else{
      if ($questoes_obj->inserir($questoes)) {
        $resultado = 1;
      }else{
        $resultado = 0;
        $erro = "Não foi possível concluir a operação";
      }
    }
  }else{
    $resultado = 0;
    $erro = "Preencha todos os campos";
  }

  if(!empty($sair) or !isset($_SESSION['usuario'])){
    unset($_SESSION['usuario']);
    session_destroy();
    echo('<script>location.href="../index.php"</script>'); 
  }         
  if (!empty($materia_cod)) {
    $_SESSION['materia_cod'] = $materia_cod;
    echo('<script>location.href="gerar_provas.php";</script>');
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
                  echo("<a class='collapse-item' onclick=ft(");
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
              <?php
              if (isset($resultado) and $resultado == 1) {
                echo("<center>");
                echo("<div class='alert alert-success' role='alert'>Operação concluida </div>");
                echo("</center>");
              }
              if (!empty($erro) and isset($resultado) and $resultado == 0) {
                echo("<center>");
                echo("<div class='alert alert-danger' role='alert'>");
                echo($erro);
                echo("</div> </center>");
              }
              ?>
              <!-- Page Heading -->
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Questões:<?= $assunto[0]['nome'];?></h1>

              </div>

              <center>
                <!-- Content Row -->
                <form enctype="multipart/form-data" method="POST" id="FormQ">
                  <label>Corpo:</label>
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <textarea class="form-control" name="corpo" id="corpo" rows="5" cols="80" style="width: 50%; margin-left: 25%;"></textarea>
                  </div>
                  <h6>Área de imagem:</h6>
                  <div id="image-holder">
                    <img src="img/thumb.svg" class="img-thumbnail">
                    
                  </div>

                  <div class='input-wrapper'>
                    <label id="label" for='input-file'>
                      Selecionar um arquivo
                    </label>
                    <input id='input-file' type='file' name="arquivo"  />
                  </div>

                  <h6>Comando:<b style="color: red">*</b></h6>
                  <div class="input-group mb-3" style="margin-left: 23%;">
                    <textarea name="comando" required="required" id="comando" rows="5" cols="80" style="width: 53.8%;"></textarea>
                  </div>
                  <h6>Itens:</h6>
                  <div class="input-group mb-3" style="margin-left: 23%;">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">A</span>
                    </div>
                    <textarea name="item_a" id="item_a" rows="5" cols="80" style="width: 50%;"></textarea>
                  </div>

                  <div class="input-group mb-3" style="margin-left: 23%;">
                    <div class="input-group-prepend">
                      <span class="input-group-text "  id="basic-addon1">B</span>
                    </div>
                    <textarea name="item_b" id="item_b" rows="5" cols="40" style="width: 50%; "></textarea>
                  </div>

                  <div class="input-group mb-3" style="margin-left: 23%;">
                    <div class="input-group-prepend">
                      <span class="input-group-text "  id="basic-addon1">C</span>
                    </div>
                    <textarea name="item_c" id="item_c" rows="5" cols="40" style="width: 50%; "></textarea>
                  </div>

                  <div class="input-group mb-3" style="margin-left: 23%;">
                    <div class="input-group-prepend">
                      <span class="input-group-text "  id="basic-addon1">D</span>
                    </div>
                    <textarea name="item_d" id="item_d" rows="5" cols="40" style="width: 50%; "></textarea>
                  </div>

                  <div class="input-group mb-3" style="margin-left: 23%;">
                    <div class="input-group-prepend">
                      <span class="input-group-text "  id="basic-addon1">E</span>
                    </div>
                    <textarea name="item_e" id="item_e" rows="5" cols="40" style="width: 50%; "></textarea>
                  </div>
                  <input type="hidden" name="submt" id="submt">
                </form>

                <button onclick="OpenModal()" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "></i>Concluir</button>
              </center>

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

        <!-- Cadastrar Modal-->
        <div class="modal fade" id="CadastrarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Concluir Operação <br></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST">
                  <h5>Deseja continuar?</h5>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                  <button class="btn btn-primary" id="FinishButton" type="button" >Concluir</button>

                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
          function ft(cod) {
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
          function preencherTxt(){
            <?php  
            if (isset($_SESSION['cod_ed']) and !empty($_SESSION['cod_ed'])) {
              $questoes_ed = $questoes_obj->carregarCod($_SESSION['cod_ed']);
              foreach ($questoes_ed as $questao_ed) {
                echo('$("#corpo").val('."'".$questao_ed['corpo']."'".');'.
                 '$("#comando").val('."'".$questao_ed['comando']."'".');');
                echo("\n");
                echo('$("#item_a").val('."'".$questao_ed['item_a']."'".');'.
                 '$("#item_b").val('."'".$questao_ed['item_b']."'".');'.
                 '$("#item_c").val('."'".$questao_ed['item_c']."'".');');
                echo("\n");
                echo('$("#item_d").val('."'".$questao_ed['item_d']."'".');'.
                 '$("#item_e").val('."'".$questao_ed['item_e']."'".');');
                echo( 'var image_holder = $("#image-holder");');
                echo('image_holder.empty();');
                if (!empty($questao_ed)){
                 echo('$("<img />", {
                  "src":'.'"'.$questao_ed['imagem'].'"'.' ,
                  "class": "img-thumbnail",
                  "style": "width:450px;height:450px;"
                }).appendTo(image_holder);');
               }
               
             }
           }
           ?>
         }
         window.onload = preencherTxt();
         function OpenModal(){
          $("#CadastrarModal").modal('show');
          $("#FinishButton").click(function(){
            $("#submt").val(1);
            $("#FormQ").submit();
          });
        }

      </script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <script type="text/javascript">
        $('#item_a').val().replace(/^\s+|\s+$/g,"");
        $('#item_b').val().replace(/^\s+|\s+$/g,"");
        $('#item_c').val().replace(/^\s+|\s+$/g,"");
        $('#item_d').val().replace(/^\s+|\s+$/g,"");
        $('#item_e').val().replace(/^\s+|\s+$/g,"");
        $('#comando').val().replace(/^\s+|\s+$/g,"");
        $('#corpo').val().replace(/^\s+|\s+$/g,"");
      </script>
      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin-2.min.js"></script>
      <script type="text/javascript">
        $("#input-file").on('change', function () {

          if (typeof (FileReader) != "undefined") {

            var image_holder = $("#image-holder");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function (e) {
              $("<img />", {
                "src": e.target.result,
                "class": "img-thumbnail",
                "style": "width:450px;height:450px;"
              }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
          } else{
            alert("Este navegador nao suporta FileReader.");
          }
        });
      </script>


    </body>

    </html>
