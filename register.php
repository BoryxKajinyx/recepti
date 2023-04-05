<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registracija</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/register.css" rel="stylesheet">
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
        <h2 class="form-register-heading" align="center">Registracija</h2>
        <form action="register.php" method="POST" class="form-register" novalidate>
            Uporabniško ime: <input type="text" name="username" required="required" class="form-control"><br/>
            Geslo: <input type="password" name="password" required="required" class="form-control"><br>
            <input type="submit" value="Register" class="btn btn-lg btn-primary btn-block">
        </form>
        <div style="text-align:center">
        <a href="login.php">Prijavi se</a><br><br>
        <a href="index.php" class="btn btn-default btn-lg active">Vrni se na začetno stran</a>
    </div>
    </body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        $username = $_POST['username'];
        $password = $_POST['password']; 
        $bool = true;
        $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
        $res = mysqli_query($mojsql, "select * from users", MYSQLI_USE_RESULT);
        //print_r($res); 
        if($res){ 
            while($row = mysqli_fetch_row($res)){
                if($username == $row[1] ){
                    $bool = false;
                    print '<script>alert("Uporabniško ime je zasedeno!")</script>';
                } 
            } 
        }  
        if($bool){
            $res=mysqli_query($mojsql, "insert into users (username,password) values('$username','$password')");
            print '<script>alert("Uspešno registriran")</script>';
            print '<script>window.location.assign("login.php");</script>';
        } 
        
    }

?>