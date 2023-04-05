<?php
session_start();
if(!$_SESSION['user']){
    header("location:index.php");
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
    $userid=mysqli_fetch_array(mysqli_query($mojsql,"select ID from users where username='".$_SESSION['user']."'"))['ID'];
    $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
    $id = $_GET['id'];
    $res=mysqli_query($mojsql, "delete from komentar where id_komentarja='$id' and id_uporabnika='$userid'");
    header("location:view.php?id=".$_GET['re']);
}
?>