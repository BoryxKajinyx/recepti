<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj recept</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
    <?php
    session_start();
    if($_SESSION['user']){
    }
    else{
        header("locaton:index.php");
    } 

    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        $recept = $_POST['recept'];
        $naslov=$_POST['naslov'];
        $sestavine = $_POST['sestavine'];
        $date = strftime("%F %X");
        //Print "$time - $date - $details"; echo "<br>";
        $decision = $_POST['public'];

        $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
        $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
        $user=$_SESSION['user'];
        $userid=mysqli_fetch_array(mysqli_query($mojsql,"select ID from users where username='$user'"))['ID']; 
        $res=mysqli_query($mojsql, "insert into recepti(ID_uporabnika, naslov, sestavine, recept, dodano, urejeno, public) values('$userid','$naslov','$sestavine','$recept','$date','$date','$decision')");
        header("location:home.php");
    }  
?> 
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
                    <li class="active"><a href="home.php">Domov</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">Odjava</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div style="text-align:center;border:1px inset black">
        <form action="add.php" method="POST" id="add" role="form" class="form-horizontal">
            <h2 id="addRecept">Objavi recept:</h2>
            <div>
                <label for="addNaslov">Naslov:</label><br>
                <input type="text" name="naslov" placeholder="Naslov" id="addNaslov"><br>
            </div>
            <div>
                <label>Sestavine:</label><br>
                <textarea name="sestavine" form="add" cols="50" rows="5" placeholder="Sestavine" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' style="resize:none"></textarea><br>
            </div>
            <div>
                <label>Recept:</label><br>
                <textarea name="recept" form="add" cols="50" rows="5" placeholder="Recept" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' style="resize:none"></textarea><br>
            </div>
            <div>
                <label>
                    Javna objava?<input type="checkbox" name="public" value="yes" ><br>
                </label>
            </div>
            <input type="submit" value="Dodaj recept">
        </form><br>
    </div>
</body>
</html>