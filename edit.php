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
    <h2 align="center">Izbran recept:</h2>
    <table width="100%" class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Naslov</th>
            <th>Uporabnik</th>
            <th>Sestavine</th>
            <th>Recept</th>
            <th>Dodano</th>
            <th>Urejeno</th>            
            <th>Javno</th>         
        </tr>
        <?php
            if(!empty($_GET['id'])){
                $pravi_uporabnik=false;
                $id = $_GET['id'];
                $id_exists = true;
                $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
                $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
                $query=mysqli_query($mojsql, "select ID_recepta, username as uporabnik, naslov, recept, sestavine, dodano, urejeno, public from recepti join users on ID=ID_uporabnika where ID_recepta=".$id);
                $count = mysqli_num_rows($query);
                $userid=mysqli_fetch_array(mysqli_query($mojsql,"select ID from users where username='$user'"))['ID'];
                $pravi_uporabnik=mysqli_fetch_array(mysqli_query($mojsql,"select ID_uporabnika from recepti where ID_recepta=".$id))['ID_uporabnika']==$userid;
                if($count > 0){
                    while($row = mysqli_fetch_array($query)){
                        print "<tr>";
                        print '<td align "center">'.$row['ID_recepta'] . "</td>"; 
                        print '<td align "center">'.$row['naslov'] . "</td>";
                        print '<td align "center">'.$row['uporabnik'] . "</td>";
                        print '<td align "center">'.$row['sestavine'] . "</td>"; 
                        print '<td align "center">'.$row['recept'] . "</td>";
                        print '<td align "center">'.$row['dodano'] . "</td>";
                        print '<td align "center">'.$row['urejeno'] . "</td>";  
                        print '<td align "center">'.$row['public'] . "</td>";
                        print "</tr>";
                    }
                }
                else{
                    $id_exists = false;
                }

            }
        ?>
    </table>
    <br>
    <?php
        if(!$pravi_uporabnik){
            print '<h2 align="center">Napačen uporabnik.</h2>';
        }
        else if($id_exists){
            print '<div style="border:2px inset black;"><form action="edit.php" method="POST" id="edit">
            <label>Vnesi nove sestavine:</label><br>
            <textarea name="sestavine" form="edit" cols="50" rows="5" placeholder="Sestavine" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\' style="resize:none"></textarea><br>
            <label>Vnesi nov recept:</label><br> 
            <textarea name="recept" form="edit" cols="50" rows="5" placeholder="Recept" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\' style="resize:none"></textarea><br>
            Javno? <input type="checkbox" name="public" value="yes"/><br>
            <input type="submit" value="Posodobi recept"/>
            <input type="hidden" name="idrecepta" value="'.$id.'"/>
        </form></div>';
        }
        else {
            print '<h2 align="center">Ni recepta.</h2>';
        }
    ?>
    
</body>
</html>

<?php 
    if($_SERVER['REQUEST_METHOD']== "POST"){
        $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
        $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
        $details = $_POST['sestavine'];
        $recept= $_POST['recept'];
        $public = $_POST['public'];
        $id = $_POST['idrecepta'];
        $date = strftime("%F %X");

        $query=mysqli_query($mojsql, "UPDATE recepti SET recept='$recept',sestavine= '$details', public='$public', urejeno='$date' WHERE id_recepta='$id'");

        header("location:home.php");
    }
?>