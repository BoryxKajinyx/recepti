<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Recepti</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Domov</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <form action="checklogin.php" method="POST" class="form-signin" novalidate>
        <h2 class="form-signin-heading">Prijava</h2>
        Uporabniško ime: <input type="email" name="username" required="required" class="form-control"><br>
        Geslo: <input type="password" name="password" required="required" class="form-control"><br>
        <input type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
    </form>
    <div style="text-align:center">
        <a href="register.php" >Registriraj se</a><br><br>
        <a href="index.php" class="btn btn-default btn-lg active">Vrni se na začetno stran</a>
    </div>
</body>
</html>