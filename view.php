<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recept</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
    <?php 
        session_start();
        if($_SESSION['user']){
        }
        else{
            header("location:index.php");
        }
        $user = $_SESSION['user'];
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
                <li><a href="home.php">Domov</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul class="nav navbar-nav navbar-right">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Odjava</a></li>
            </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <?php
        if(empty($_GET['id'])){
            header("home.php");
        }
        $idrecepta=$_GET['id'];
        $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
        $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
        $recept = mysqli_fetch_array(mysqli_query($mojsql, "select id_recepta, id_uporabnika, username as uporabnik, naslov, sestavine, recept, dodano, urejeno, public from recepti join users on ID=ID_uporabnika where id_recepta='$idrecepta'"));
        print '<div style="border:1px inset black">';
        print '<h2>'.$recept['naslov'].'</h2>';
        print '<h3>Sestavine:</h3>';
        print '<p >'.$recept['sestavine'].'</p>';
        print '<h3>Recept:</h3>';
        print '<p>'.$recept['recept'].'</p>';
        print '<div style="text-align: right;margin-right:20px;color:gray;">';
        print '<p>Dodano:'.$recept['dodano'].'</p>';
        print '<p>Urejeno:'.$recept['urejeno'].'</p>';
        print '</div>';
        print '</div>';
    ?>
    <form action="addcomment.php" method="POST">
        <h2>Objavi komentar:</h2>
        Komentar: <input type="text" name="komentar"><br>
        <input type="hidden" name="recept" value="<?php echo $idrecepta;?>">
        <input type="submit" value="Dodaj komentar">
    </form>
    <a href="home.php">Nazaj</a>
    <table border="1px" width="100%">
        <tr>
            <th>Uporabnik</th>
            <th>Komentar</th>
            <th>Dodano</th>
            <th>Urejeno</th>
            <th>Uredi</th>
            <th>Izbriši</th>
        </tr>
        <?php

            $res=mysqli_query($mojsql, "select id_komentarja, id_recepta, username as uporabnik, komentar, dodano, urejeno from komentar join users on ID=ID_uporabnika where id_recepta='$idrecepta'", MYSQLI_STORE_RESULT);
            while($row = mysqli_fetch_array($res)){
                print "<tr>";
                print '<td align "center">'.$row['uporabnik'] . "</td>"; 
                print '<td align "center">'.$row['komentar'] . "</td>"; 
                print '<td align "center">'.$row['dodano'] . "</td>";
                print '<td align "center">'.$row['urejeno'] . "</td>";  
                print '<td align "center"><a href="#" onclick="editfunction('.$row['id_komentarja'].','.'\''.$row['uporabnik'].'\''.','.'\''.$user.'\''.')">Uredi</a></td>';
                print '<td align "center"><a href="#" onclick="deletefunction('.$row['id_komentarja'].','.'\''.$row['uporabnik'].'\''.','.'\''.$user.'\''.')">Izbriši</a></td>'; 
                print "</tr>";
            } 
        ?>
    </table>
    <script>
        function deletefunction(id,uporabnik,user){
            var r=confirm("Are you sure?");
            if(r==true&&uporabnik==user){
                back=<?php echo json_encode($idrecepta)?>;
                window.location.assign("deletecomment.php?id="+id+"&re="+back);
            }
        }
        function editfunction(id,uporabnik,user){
            if(uporabnik==user){
                window.location.assign("editcomment.php?id="+id);
            }
        }
    </script>
</body>
</html>