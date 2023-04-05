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
    else{
        header("location:home.php");
    }  
?> 