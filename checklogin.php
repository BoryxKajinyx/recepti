<?php
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $bool = true;
    $mojsql = mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
    $res = mysqli_query($mojsql, "select * from users where username='$username'", MYSQLI_USE_RESULT);
    $exists = mysqli_num_fields ($res);

    $table_users = "";
    $table_passwd = "";
    if($exists > 0){
        while($row = mysqli_fetch_assoc($res)){
            $table_users = $row['username'];
            $table_password = $row['password'];  
        } 
        if(($username == $table_users)&&($password == $table_password)){
            $_SESSION['user'] = $username;
            header("location: home.php");
        }
        else{
            print '<script>alert("Nepravilno up. ime ali geslo!")</script>';
            print '<script>window.location.assign("login.php");</script>';
        } 

    } 
    else{
        print '<script>alert("Nepravilno up. ime ali geslo!")</script>';
        print '<script>window.location.assign("login.php");</script>';
    } 
?>