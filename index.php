<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prva stran</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Default</a></li>
            <li><a href="../navbar-static-top/">Static top</a></li>
            <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="jumbotron">
      <div class="container">
        <h1>Janezovi recepti</h1>
        <p>To je spletna stran, na kateri lahko objavite svoje recepte ali pa poiščete recept od koga drugega. Na vse recepte lahko tudi komentirate, svoje recepte in komentarje lahko tudi urejate.</p>
        <a class="btn btn-primary btn-lg" href="login.php" role="button">Prijava &raquo;</a>&nbsp;&NonBreakingSpace;
        <a class="btn btn-primary btn-lg" href="register.php" role="button">Registracija &raquo;</a>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Recepti</h2>
          <p>Recepte lahko objavi vsak uporabnik. Za ogled in objavo receptov se morate prijaviti. Če es še niste registrirali, se lahko registrirate ZDAJ!</p>
          <p><a class="btn btn-default" href="#" role="button">REGISTRIRAJTE SE ZDAJ! &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Komentarji</h2>
          <p>Na recepte lahko komentira vsak uporabnik. Za komentiranje se morate prijaviti. Če es še niste registrirali, se lahko registrirate ZDAJ!</p>
          <p><a class="btn btn-default" href="#" role="button">REGISTRIRAJTE SE ZDAJ! &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Iskanje receptov</h2>
          <p>Iskanje receptov ne bi moglo iti lažje! Recepte lahko iščete po sestavinah, ki so uporabljene v receptu.</p>
          <p><a class="btn btn-default" href="#" role="button">REGISTRIRAJTE SE ZDAJ! &raquo;</a></p>
        </div>
      </div>

</body>
</html>