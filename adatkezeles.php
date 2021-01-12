<?php

function letezik($e){
    return isset(json_decode(file_get_contents("adatok.json"))->felhasznalok->$e);
} 

function jelszo($e, $pw){
    return password_verify($pw, json_decode(file_get_contents("adatok.json"))->felhasznalok->$e->jelszo);
}


function konvertalo($eredeti){
    $teljesuj=array();
    $uj=array();

    for($i=0;$i<strlen($eredeti);$i++){
        if(preg_match("/^[0-9]*$/",$eredeti[$i])){
            array_push($uj,(int)$eredeti[$i]);
        }
        elseif($eredeti[$i]=="]"){
            array_push($teljesuj,$uj);
            $uj=array();
            $i=$i+1;
        }
    }
    return $teljesuj;
}

function hozaad($uname,$e,$pw){
    $user = (object)[
        "jelszo" => password_hash($pw, PASSWORD_DEFAULT),
        "nev" =>$uname,
        "megoldottak" => []
    ];
    $json = json_decode(file_get_contents("adatok.json"));
    $json->felhasznalok->$e = $user;
    file_put_contents('adatok.json',json_encode($json,JSON_PRETTY_PRINT));
}

function aktpalya($neve) {
    $json = json_decode(file_get_contents("adatok.json"),true);
    return($json["palyak"][$neve]["tabla"]);
}

function torolpalyat($neve){

    $json = json_decode(file_get_contents("adatok.json"),true);
    unset($json["palyak"][$neve]);
    file_put_contents('adatok.json',json_encode($json,JSON_PRETTY_PRINT));
}

function getNev($e){
    return (json_decode(file_get_contents("adatok.json"))->felhasznalok->$e->nev);
}

function setmegoldottak($e,$neve){
    if(!megoldottake($e, $neve)){
        $json = json_decode(file_get_contents("adatok.json"));
        $json->felhasznalok->$e->megoldottak[] = $neve;
        $json->palyak->$neve->megoldasszam +=1;
        file_put_contents('adatok.json',json_encode($json,JSON_PRETTY_PRINT));
    }
    //$json = json_decode(file_get_contents("adatok.json"));
    //return json_encode($json->felhasznalok->$e);
}

function megoldottake($e, $neve){
    return in_array($neve, json_decode(file_get_contents("adatok.json"))->felhasznalok->$e->megoldottak);
}


function ujpalya($nev,$nehezseg, $sorok, $oszlopok, $tabla){
    $ujpalya = (object)[
        "tabla" => $tabla,
        "nev" => $nev,
        "nehezseg" => $nehezseg,
        "sorok" => $sorok,
        "oszlopok" => $oszlopok,
        "megoldasszam" => 0
    ];
    $json = json_decode(file_get_contents("adatok.json"));
    $json->palyak->$nev = $ujpalya;
    file_put_contents('adatok.json',json_encode($json,JSON_PRETTY_PRINT));
}

function palyak(){
    return json_decode(file_get_contents("adatok.json"))->palyak;
}

function megoldott($nev,$felhasznalo){
    return in_array($nev,json_decode(file_get_contents("adatok.json"))->felhasznalok->$felhasznalo->megoldottak);
}




?>