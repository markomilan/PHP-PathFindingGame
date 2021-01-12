<?php

session_start();
require("adatkezeles.php");
ujpalya($_POST["nev"],$_POST["nehezseg"],(int)$_POST["sorok"],(int)$_POST["oszlopok"],konvertalo($_POST["apalya"]));
header("Location: index.php");

?>
