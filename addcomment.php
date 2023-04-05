<?php
    session_start();
    if($_SESSION['user']){
    }
    else{
        header("locaton:index.php");
    } 

    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        $recept = $_POST['recept'];
        $komentar = $_POST['komentar'];
        $date = strftime("%F %X");
        $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
        $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
        $user=$_SESSION['user'];
        $userid=mysqli_fetch_array(mysqli_query($mojsql,"select ID from users where username='$user'"))['ID']; 
        $res=mysqli_query($mojsql, "insert into komentar(id_uporabnika, komentar, id_recepta, dodano, urejeno) values('$userid','$komentar','$recept','$date','$date')");
        header("location:view.php?id=$recept");
    }
    else{
        header("location:home.php");
    }  

?> 