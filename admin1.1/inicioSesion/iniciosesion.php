
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADMIN Login Page</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
  </head>
  <body class="bg-success d-flex justify-content-center align-items-center vh-100">
    <div
      class="bg-white p-5 rounded-5 text-secondary shadow"
      style="width: 25rem"
    >
      <div class="d-flex justify-content-center">
        <img
          src="assets/logo.png"
          alt="login-icon"
          style="height: 5rem"
        />
      </div>
      <div class="text-center fs-1 fw-bold">Login Admin</div>
      
      <form method="POST" action="" >
      <?php
  include('controlador.php');
  ?>
     

      <div class="input-group mt-4">
        <div class="input-group-text bg-info">
          <img
            src="assets/username-icon.svg"
            alt="username-icon"
            style="height: 1rem"
          />
        </div>
        <input
          class="form-control bg-light"
          type="text"
          placeholder="email"
          name="email"
        />
      </div>
      <div class="input-group mt-1">
        <div class="input-group-text bg-info">
          <img
            src="assets/password-icon.svg"
            alt="password-icon"
            style="height: 1rem"
          />
        </div>
        <input
          class="form-control bg-light"
          type="password"
          name="password"
          placeholder="password"
        />
      </div>
   
      <div class="d-flex justify-content-around mt-1">
        <div class="pt-1">
          <a
            href="#"
            class="text-decoration-none text-info fw-semibold fst-italic"
            style="font-size: 0.9rem"
            >Forgot your password?</a
          >
        </div>
      </div>
      <div class="row">
      <input type="submit" class="btn btn-info" value="iniciar sesion" name="boton">
      
      </div>
  
    </form>
   
    </div>
  </body>
</html>