<?php session_start(); ?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Webprogramozás beadandó</title>
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
</head>
<body>
    <picture>
        <img src="logo.jpg" alt="logo" height="100" width="100">
    </picture>
    <br><br>
    
    
    <?php
        $bejelentkezve = isset($_SESSION["uname"]);
    ?>


    <?php if($bejelentkezve): ?>
        <?php require("loggedin.php"); ?>

        <br><br>

        <form action="logout.php" method="post">
            <input name="logout" type="submit" value="Kijelentkez">
        </form>

    <?php else: ?>
        <Név>
        <Neptun ID>
        <Tárgy & beadandó neve>
        <Beküldés ideje>
        Markó Milán
        GZCLIE
        Webprogramozás & PHP beadandó
        Beküldés ideje
        Ezt a megoldást Markó Milán, GZCLIE küldte be és készítette a Webprogramozás kurzus küldöncök feladatához.
        Kijelentem, hogy ez a megoldás a saját munkám.
        Nem másoltam vagy használtam harmadik féltől származó megoldásokat.
        Nem továbbítottam megoldást hallgatótársaimnak, és nem is tettem közzé.
        Az Eötvös Loránd Tudományegyetem Hallgatói Követelményrendszere (ELTE szervezeti és működési szabályzata, II. Kötet, 74/C. §) kimondja, 
        hogy mindaddig, amíg egy hallgató egy másik hallgató munkáját - vagy legalábbis annak jelentős részét - saját munkájaként mutatja be, 
        az fegyelmi vétségnek számít. A fegyelmi vétség legsúlyosabb következménye a hallgató elbocsátása az egyetemről.
        <br><br><br>
        Ez egy logikai játék,az azonos szinű négyzeteket össze kell kötni egy vonallal,a többi vonal
        vagy négyzet érintése nélkül.<br>Ha ez sikerült a játékosnak a pályá sikeresen teljesitett.
        <br><br>

        Bejelentkezés<br>
        <form action="login.php" method="post">
            Email: <input type="email" name="e" placeholder="pl.: nev@valami.hu"> <br>
            Jelszó: <input type="password" name="pw"> <br>
            <input name="login" type="submit" value="Bejelentkez">
        </form>
        <?php if(isset($_GET["hiba"]) && $_GET["hiba"] == "login_rossz"): ?>
            Rossz bejelentkezési adatok.
        <?php endif ?>

        <br><br>

        Regisztráció<br>
        <form action="register.php" method="post">
            Felhasználónév: <input name="uname"> <br>
            Email: <input type="email" name="e" placeholder="pl.: nev@valami.hu"> <br>
            Jelszó: <input type="password" name="pw1"> <br>
            Jelszó megint: <input type="password" name="pw2"> <br>
            <input name="register" type="submit" value="Regisztral">
        </form>
        <br><br><br>
        <div>
        <button id="uj">Új játék</button>
        <select id="nehezseg">
            <option  value="konnyu">konnyu</option>
            <option value="kozepes">kozepes</option>
            <option value="nehez">nehez</option>
        </select>
    </div>
    <div id="kuldoncok">
        <tbody>
            <table id="entabla"></table>
        </tbody>

    </div>
    
    <script src="seged.js"></script>
    <script src="index.js"></script>


        <?php if(isset($_GET["hiba"])): ?>
            <?php if($_GET["hiba"] == "register_letezik"): ?>
                Ilyen E-mail már létezik a rendszerben.
            <?php elseif($_GET["hiba"] == "register_e"): ?>
                Az E-mail címnek helyes formátumunak kell lennie.
            <?php elseif($_GET["hiba"] == "register_uname"): ?>
                A felhasználónév csak betűkből és számokból állhat, és legalább 5 karakternek kell lennie.
            <?php elseif($_GET["hiba"] == "register_pw"): ?>
                A jelszó nem tartalmazhat speciális karaktert, és legalább 5 karakter hosszúnak kell lennie.
            <?php elseif($_GET["hiba"] == "register_pw_nomatch"): ?>
                A jelszavak nem egyeznek.                
            <?php endif ?>
        <?php endif ?>

    <?php endif ?>
</body>
</html>