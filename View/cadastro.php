<?php
include '../Controler/UsuarioDAO.php';
include '../Model/Usuario.php';
$usuario_dao = new UsuarioDAO;
$senha = isset($_POST['passwd'])?$_POST['passwd']:"";
$confsenha = isset($_POST['repeat_passwd'])?$_POST['repeat_passwd']:"";
$user = isset($_POST['user'])?$_POST['user']:"";
$email = isset($_POST['email'])?$_POST['email']:"";
$existe = $usuario_dao->verificaDados($email,$user);
if ($senha != $confsenha) {
  $erro = "Senhas diferentes";
}
if (!empty($user) and !empty($senha) and !empty($email) and !$existe and $senha == $confsenha) {
  $usuario_obj = new Usuario;
  $senha = sha1($senha);
  $usuario_obj->setEmail($email);
  $usuario_obj->setPasswd($senha);
  $usuario_obj->setUser($user);
  $user = $usuario_dao->inserir($usuario_obj);
  if ($user) {
    echo("<script>location.href='login.php';</script>");
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

  <title>Atena - Registro</title>

  <!-- Custom fonts for this template-->
  <link rel="icon" type="image/png" href="img/logo.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Criar Conta !</h1>
              </div>
              
              <div class="container">
                <form class="user" id="form_cadastro" method="POST">
                  <div class="form-group row">
                    <div class="col-sm-12 mb-12 mb-sm-12">
                      <input type="text" required="required" class="form-control form-control-user" name="user" id="user" placeholder="Nome de Usuário">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="email" required="required" class="form-control form-control-user"  name="email" id="email"  placeholder="Endereço de Email">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" required="required" class="form-control form-control-user" id="passwd" name="passwd" placeholder="Password">
                    </div>
                    <div class="col-sm-6">
                      <input type="password" required="required" class="form-control form-control-user" id="repeat_passwd" name="repeat_passwd" placeholder="Repeat Password">
                    </div>

                  </div>
                  <div id="confirm_passwd" style="color: red; text-align: center;">    
                    <?php  if ($existe) {
                     echo("Email ou Usuário já em uso");
                   }
                   if (!empty($erro)) {
                     echo($erro);
                   }
                   ?>
                 </div>
                 <button class="btn btn-primary btn-user btn-block" id="cadastrar_btn">
                  Registrar
                </button>
              </form>
              <div class="text-center">
                <a class="small" href="login.php">Já possui uma conta? Clique aqui para logar</a>
              </div>
            </div> 
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js">
</script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/jquery.mask.js"></script>
</body>

</html>
