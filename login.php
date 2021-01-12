<?php
    session_start();
    require_once("adatkezeles.php");
    if(isset($_POST["login"])){
        if(jelszo($_POST["e"],$_POST["pw"])){
            $_SESSION["uname"] = getNev($_POST["e"]);
            $_SESSION["e"]=$_POST["e"];
            header("Location: index.php");
        }else{
            header("Location: index.php?hiba=login_rossz");
        }

    }else{
        header("Location: index.php");
    }

?>