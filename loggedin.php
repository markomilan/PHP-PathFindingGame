<style>
    table, tr, td{
        border: 1px solid black;
        border-collapse: collapse;
    }
    td{
        width: 100px;
    }
</style>
<?php
require_once("adatkezeles.php");
$palyak=palyak();
echo "Hello ".$_SESSION["uname"]." => ".$_SESSION["e"];
if($_SESSION["uname"]=="admin"):?>    
    <form action="ujpalya.php" method="post">
    <br>
    Palya letrehozas
    <br>
    Nev: <input name="nev">
    Nehezseg: <input name="nehezseg">
    Sorok: <input name="sorok">
    oszlopok: <input name="oszlopok">
    <br><br>
    A palya: <textarea name="apalya"></textarea>
    <input type="submit" value="Szerkeszt">
    </form>
    <br>
    <form action="palyatorol.php" method="post">
    Palya torles,adja meg a nevet: <input name="nev"><input type="submit" value="Torol">
    </form>
    <br><br>
    <?php endif ?>
<table>
<tr>
    <td>Nev</td>
    <td>Nehezseg</td>
    <td>Megoldasszam</td>
    <td>Megoldotta e?</td>
    <td>Indit</td>
</tr>
<form action="palyaindit.php" method="post">
<?php foreach($palyak as $palya):?>
    <tr>
        <td><?=$palya->nev?></td>
        <td><?=$palya->nehezseg?></td>
        <td><?=$palya->megoldasszam?></td>
        <?php if(megoldott($palya->nev,$_SESSION["e"])):?><td>Igen</td>
        <?php elseif(!megoldott($palya->nev,$_SESSION["e"])):?><td>Nem</td>
        <?php endif ?> 
        <td><input name="akt" type="submit" value= <?php echo ($palya->nev);?> ></td>
    </tr>
<?php endforeach ?>
</form>
</table>


