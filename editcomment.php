<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urejanje</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
</head>
<?php
session_start();
if(!$_SESSION['user']) {
    header("location: index.php");
}
$user = $_SESSION['user']; 
$id_exists = false;
?>
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
                <li><a href="home.php">Domov</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Odjava</a></li>
            </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <?php
        if(!empty($_GET['id'])){
            print '<h2>Urejanje komentarja</h2>';
            print '<p>Hello '.$user.'</p>';
            print '<a href = "logout.php">Odjava</a><br>';
            print '<a href = "home.php">Domov</a><br>';
            $pravi_uporabnik=false;
            $idkomentarja = $_GET['id'];
            $id_exists = true;
            $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
            $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
            $res=mysqli_query($mojsql, "select id_recepta, username as uporabnik, komentar, dodano, urejeno from komentar join users on ID=ID_uporabnika where id_komentarja=".$idkomentarja);
            $row=mysqli_fetch_array($res);
            $idrecept=$row['id_recepta'];
            print '<a href="view.php?id='.$idrecept.'"a>Nazaj</a>';
            $userid=mysqli_fetch_array(mysqli_query($mojsql,"select ID from users where username='$user'"))['ID'];
            $pravi_uporabnik=mysqli_fetch_array(mysqli_query($mojsql,"select ID_uporabnika from komentar where ID_komentarja=".$idkomentarja))['ID_uporabnika']==$userid;
            print '<h2 align="center">Izbran komentar</h2>';
            print '<table border="1px" width="100%">';
            print '<tr>';
            print '<th>Uporabnik</th>';
            print '<th>Komentar</th>';
            print '<th>Dodano</th>';
            print '<th>Urejeno</th>';
            print '</tr>';
            print "<tr>";
            print '<td align "center">'.$row['uporabnik'] . "</td>"; 
            print '<td align "center">'.$row['komentar'] . "</td>"; 
            print '<td align "center">'.$row['dodano'] . "</td>";
            print '<td align "center">'.$row['urejeno'] . "</td>";  
            print "</tr>";
            print "</table>";              
        }
    ?>
    <br>
    <?php
        if(!$pravi_uporabnik){
            print '<h2 align="center">Napačen uporabnik.</h2>';
        }
        else if($id_exists){
            print '<form action="editcomment.php" method="POST">
            Vnesi nov komentar: <input type="text" name="komentar"/><br>
            <input type="submit" value="Posodobi komentar"/>
            <input type="hidden" name="id" value="'.$idkomentarja.'"/>
            <input type="hidden" name="recept" value="'.$idrecept.'"/>
            </form>';
        }
        else {
            print '<h2 align="center">Ni komentarja.</h2>';
        }
    ?>
</body>
</html>

<?php 
    if($_SERVER['REQUEST_METHOD']== "POST"){
        $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
        $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
        $komentar = $_POST['komentar'];
        $recept=$_POST['recept'];
        $id = $_POST['id'];
        $date = strftime("%F %X");

        $query=mysqli_query($mojsql, "UPDATE komentar SET komentar='$komentar', urejeno='$date' WHERE id_komentarja='$id'");
        header("location:view.php?id=".$recept);
    }
?>