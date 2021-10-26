
<?php
$mensaje="";
if(isset($_POST['username']) && isset($_POST['password'])){

  $user = htmlspecialchars($_POST['username'], ENT_QUOTES ,"UTF-8");
  $pass = htmlspecialchars($_POST['password'], ENT_QUOTES ,"UTF-8");
  $save = isset($_POST['save'])? true : false;

  require_once (dirname(__FILE__)."/../cms/controllers/worker/loginUser.php");  

  $loginControl = new Login();
  
  $res = $loginControl->auth($user, $pass, $save);

  if($res==1){    
   header("Location: ../cms/"); 
  }else{
    $mensaje = $res[1];
  } 
}

?>

<!-- onsubmit="return false;" -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <title>Inicio de Sesión & Formulario de Registro</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form  method="post"  class="sign-in-form">
            <h2 class="title">Iniciar Sesión</h2>

            <div class="alert alert-danger" role="alert" style="color: rgb(255 59 0)">
              <?php echo $mensaje?>
            </div>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Nombre usuario" value="" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Contraseña" value="" />
            </div>
            <div class="form-group form-check">
              <input type="checkbox"  name="save" value="1" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Guardar Sessión</label>
            </div>
            <input type="submit" name="login" value="Iniciar Sesíon" class="btn solid" />
            <p class="social-text">Visita Nuestras redes sociales</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form onsubmit="alert('stop submit'); return false;" method="post" class="sign-up-form">
            <h2 class="title">Ingrese Sus Datos</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Usuario" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Contraseña" />
            </div>
            <input type="submit" class="btn" value="Registrar" />
            <p class="social-text">Visita Nuestras redes sociales</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Eres Nuevo Aqui?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Quiero Registrarme
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Quieres Comunicarte Con nosotros?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Iniciar Sesión
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
    <script>
    	


    </script>
  </body>
</html>

