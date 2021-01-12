<?php

session_start();
require("adatkezeles.php");
torolpalyat($_POST["nev"]);
header("Location: index.php");

//ide még egy fg. ami törli a megoldottak közül is a játékot

?>