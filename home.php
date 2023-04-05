<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glavna stran</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
    <?php 
        session_start();
        if($_SESSION['user']){
        }
        else{
            header("location: index.php");
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
                    <li class="active"><a href="home.php">Domov</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">Odjava</a></li>
                </ul>
                <form action="home.php" method="GET" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" name="id" placeholder="sestavine">
                        <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Išči">
                </form>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    
    <?php
        if(empty($_GET['id'])){
            print '<h2 align="center">Recepti</h2>';
            print '<a href="#addRecept" class="btn btn-default btn-lg active">Dodaj recept</a>';
        }
        else{
            print'<div style="text-align:center">';
            print'<a href="home.php">Počisti iskanje</a>';
            print'<h2 align="center">Rezultati iskanja</h2>';
            print'<a href="#addRecept" class="btn btn-default btn-lg active">Dodaj recept</a>';
            print'</div>';
        }
    ?>
    <table width="100%" class="table table-hover">
        <thead class="">
            <tr>
                <th>Naslov</th>
                <th>Uporabnik</th>
                <th>Sestavine</th>
                <th>Dodano</th>
                <th>Urejeno</th>
                <th>Uredi</th>
                <th>Izbriši</th>
                <th>Javno</th>
            </tr>
        </thead>
    <?php 
        $mojsql =mysqli_connect("localhost", "user", "user", "webdata") or die(mysqli_error($mojsql));
        $test = mysqli_select_db($mojsql, "webdata") or die("Cannot connect to databese..");
        //$res;
        if(empty($_GET['id'])){
            $res=mysqli_query($mojsql, "select id_recepta, username as uporabnik, naslov, sestavine, dodano, urejeno, public from recepti join users on ID=ID_uporabnika where public='yes' or username='$user'");
        }else{
            $sestavine=$_GET['id'];
            $sestavine = htmlspecialchars($sestavine);
            $sarray= explode(",",$sestavine);
            $query="select username as id_recepta, username as uporabnik, naslov, sestavine, dodano, urejeno, public from recepti join users on ID=ID_uporabnika where (public='yes' or username='$user') and ((sestavine like '%".$sarray[0]."%')";
            for ($i=1;$i<count($sarray); $i++) { 
                $query.=" or (sestavine like '%".$sarray[$i]."%')";
            }
            $query.=")";
            //print($query);
            $res=mysqli_query($mojsql,$query);
        }
        while($row = mysqli_fetch_array($res)){
            print "<tr>";
            print '<td align "center"><a href="view.php?id='.$row['id_recepta'].'">'.$row['naslov']."</a></td>";
            print '<td align "center">'.$row['uporabnik'] . "</td>"; 
            print '<td align "center">'.$row['sestavine'] . "</td>"; 
            print '<td align "center">'.$row['dodano'] . "</td>";
            print '<td align "center">'.$row['urejeno'] . "</td>";  
            print '<td align "center"><a href="#" onclick="editfunction('.$row['id_recepta'].','.'\''.$row['uporabnik'].'\''.','.'\''.$user.'\''.')">Uredi</a></td>';
            print '<td align "center"><a href="#" onclick="deletefunction('.$row['id_recepta'].','.'\''.$row['uporabnik'].'\''.','.'\''.$user.'\''.')">Izbriši</a></td>'; 
            print '<td align "center">'.$row['public'] . "</td>";
            print "</tr>";
        } 
    ?>
    </table>
    <a id="addRecept" style="display:block;position:relative;top:-50px;visibility:hidden"></a>
    <div>
        <form action="add.php" method="POST" id="add" role="form" class="form-horizontal">
            <h2 id="addRecept">Objavi recept:</h2>
            <div>
                <label for="addNaslov">Naslov:</label>
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
        </form>
    </div>
    
    <script>
        function deletefunction(id,uporabnik,user){
            var r=confirm("Are you sure?");
            if(r==true&&uporabnik==user){
                window.location.assign("delete.php?id="+id);
            }
        }
        function editfunction(id,uporabnik,user){
            if(uporabnik==user){
                window.location.assign("edit.php?id="+id);
            }
        }
    </script>
</body>
</html>