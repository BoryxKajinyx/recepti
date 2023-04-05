<?php
session_start();
if(!$_SESSION['user']){
    header("location: index.php");
}
$userid=mysqli_fetch_array(mysqli_query($mojsql,"select ID from users where username='".$_SESSION['user']."'"));
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
    $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
    $id = $_GET['id'];
    $res=mysqli_query($mojsql, "delete from recepti where id_recepta='$id' and id_uporabnika='$userid'");
    header("location:home.php");
}
?>