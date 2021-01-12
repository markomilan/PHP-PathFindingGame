<style>
    table {
        border-collapse: collapse;
    }
    table, td {
        user-select:none;
        border: 1px solid black;
    }
    td {
        width: 2em;
        height: 2em;
        text-align: center;
    }
</style>

<?php

session_start();
require("adatkezeles.php");

//$a="99";
//echo $a;

//echo json_encode($a);

//echo $_POST["akt"];

//if(isset($_POST["name"])){
//setmegoldottak($_SESSION['e'],$_POST["akt"]);
//}

$_SESSION["aktS"]=$_POST["akt"];
echo "<table id='entabla'><td></td></table>";

/*if(isset($_SESSION["hope"])){
    echo var_dump($_GET);
    echo $_SESSION["hope"];
setmegoldottak($_SESSION['e'],$_POST["akt"]);

/*function setseged(){
    setmegoldottak($_SESSION['e'],$_POST["akt"]);
}*/
//echo setmegoldottak($_SESSION['e'],$_POST["akt"]);

?>

<form action="vissza.php">
<input name="vissza" type="submit" value="Vissza">
</form>
<form action="sikerespalya.php" method="GET">
<input name="mentes" type="submit" value="Mentes">
<input name="betoltes" type="submit" value="Betoltes">
</form>







<script src="seged.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="seged2.js"></script>
<script type="text/JavaScript"> 
    var ez =<?php echo json_encode(aktpalya($_POST["akt"]));?>;
    document.getElementById('entabla').innerHTML=tabla(ez);
</script>