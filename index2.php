<?php
$con = mysqli_connect("localhost","root","","teszteles");
if(mysqli_connect_errno()){
    echo"Hiba az adatbázishoz való csatlakozáskor: ". mysqli_connect_errno();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo'<form method="post">';
    echo'Felhasználó név: <input type="text" name="nev">';
    echo'Jelszó: <input type="password" name="jelsz">';
    echo'<input type="submit" name="bej" value="Bejelentkezés"><br>';
    echo'</form>';
    echo'<form method="get">';
    echo'<input type="submit" name="reg" value="Regisztráció_">';
    echo'</form>';

    if(isset($_POST["bej"])){
        $nev = $_POST['nev'];
        $jelszo = $_POST['jelsz'];
        $sql = "SELECT * FROM szemely WHERE nev='$nev' AND jelsz='$jelszo'";
        if($result = msqly_query($con,$sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    if($row['nev']==$_POST["nev"]&& $row['jelszo']==$_POST["pass"]){
                        echo"<a href=''>Kijelentkezés</a>";
                    }
                }
            }
        }
    }
    if(isset($_GET["reg"])){
        ?>
        <form action="" method="post">
            <input type="text" name="nev" id="" placeholder="Felhasználó név"><br><br>
            <input type="password" name="jelsz" id="" placeholder="Jelszó"><br><br>
            <input type="button" name="regisztralas" value="Regisztráció">
        </form>
        <?php
        if(!isset($_POST["regisztralas"])){
            $nev2 = $_POST['nev'];
            $jelszo = $_POST['jelsz'];
            //$con->query("INSERT INTO szemely (nev, jelsz) VALUES ('$nev','$jelszo')");
            $query = "INSERT INTO szemely (nev, jelsz) VALUES ('$nev','$jelszo')";
            print($query);
            mysqli_query($con,$query) or die ('Hiba az adatbevitelnél!');
            print("sikeres regisztráció");
        }
    }
    if($_GET['m'] == 'a'){print"a";}
    else if($_GET['m'] =='b'){print"b";}
    ?>
    <a href="?m=a">a</a>
    <a href="?m=b">b</a>
</body>
</html>