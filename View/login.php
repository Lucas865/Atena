<?php  
include '../Controler/UsuarioDAO.php';
$password = isset($_POST['password'])?$_POST['password']:"";
$user = isset($_POST['user'])?$_POST['user']:"";
if (!empty($user) and !empty($password)) {
  $password = sha1($password);
  $usuario_obj = new UsuarioDAO;
  $users = $usuario_obj->listarPorSenha($user,$password);
  if (count($users) > 0){
    session_start();
    $_SESSION['usuario'] = $users[0];
    $_SESSION['nivel_acesso'] = $users[0]['nivel_acesso'];
    echo('<script>location.href="main.php"</script>');
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

  <title>Atena - Login</title>

  <!-- Custom fonts for this template-->

  <link rel="icon" type="image/png" href="img/logo.png" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary" style="margin-top: 5%;">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem Vindo</h1>
                  </div>
                  <form class="user" id="form_login" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" required="required"  name="user"  placeholder="Usuário">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password"  required="required" placeholder="Senha">
                    </div>
                    <button class="btn btn-primary btn-user btn-block" id="btn_login">
                      Login
                    </button>
                    <hr>
                  </form>
                  <div style="color: red; text-align: center;" id="erro">
                    <?php  if (!empty($user) and count($users) == 0) {
                     echo("Usuário ou senha incorretos");
                   }?>
                 </div>
               </hr>
               <div class="text-center">
                <a class="small" href="cadastro.php">Criar conta</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

</div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript">
  $("#btn_login").click(function(){
    $("#form_login").submit();
  });
</script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>
