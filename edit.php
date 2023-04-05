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
            </ul class="nav navbar-nav navbar-right">
            <ul>
                <li><a href="logout.php">Odjava</a></li>
            </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <h2>Edit Page</h2>
    <p>Hello <?php print "$user"?>!</p>
    <a href = "logout.php">Odjava</a><br>
    <a href = "home.php">Domov</a>
    <h2 align="center">Izbran recept:</h2>
    <table border="1px" width="100%">
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
                $query=mysqli_query($mojsql, "select username as uporabnik, naslov, sestavine, dodano, urejeno, public from recepti join users on ID=ID_uporabnika from list where ID_recepta=".$id);
                $count = mysqli_num_rows($query);
                $userid=mysqli_fetch_array(mysqli_query($mojsql,"select ID from users where username='$user'"))['ID'];
                $pravi_uporabnik=mysqli_fetch_array(mysqli_query($mojsql,"select ID_uporabnika from recept where ID_recepta=".$id))['ID_uporabnika']==$userid;
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
            print '<form action="edit.php" method="POST">
            Vnesi nov recept: <input type="text" name="details"/><br>
            Javno? <input type="checkbox" name="public[]" value="yes"/><br>
            <input type="submit" value="Posodobi recept"/>
            <input type="hidden" name="idrecepta" value="'.$id.'"/>
            </form>';
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
        $details = $_POST['details'];
        $public = "no";
        $id = $_POST['idrecepta'];
        $date = strftime("%F %X");

        foreach($_POST['public'] as $list){
            if($list != null){
                $public = "yes";
            }
        }
        $query=mysqli_query($mojsql, "UPDATE list SET details= '$details', public='$public', urejeno='$date' WHERE id='$id'");
        header("location:home.php");
    }
?>