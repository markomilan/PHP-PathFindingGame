<?php
session_start();
require("adatkezeles.php");
//require("palyaindit.php");
//echo $_POST["akt"];
//echo $_SESSION["e"];
setmegoldottak($_SESSION['e'],$_SESSION['aktS']);

//if($_GET["type"]=="most"){
    //setmegoldottak($_SESSION["e"],"1");

//}

header("Location: palyaindit.php");

//$a="c";
//echo json_encode($a);
//$a=$_GET["variablename"];
//$_SESSION["hope"]=$a;
//setmegoldottak($_SESSION['e'],$_POST["akt"]);


//echo json_encode($a);


/*function ccc($egy,$ketto){
    echo $egy;
}*/

//header("Location: index.php");
?>
