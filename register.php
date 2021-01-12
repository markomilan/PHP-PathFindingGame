<?php
    session_start();
    require_once("adatkezeles.php");

    if(isset($_POST['register'])){

        if(!letezik($_POST['e'])){

            if(filter_var($_POST['e'],FILTER_VALIDATE_EMAIL) || validEmail($_POST['e'])){
            
                if(strlen($_POST['uname']) > 4 && preg_match("/^[a-zA-Z0-9áíűőüöúóéÁÍÜŐÜÖÚÓÉ]*$/",$_POST['uname'])){

                    if($_POST["pw1"] == $_POST["pw2"]){
                        
                        if(strlen($_POST['pw1']) > 4 && preg_match("/^[a-zA-Z0-9áíűőüöúóéÁÍÜŐÜÖÚÓÉ]*$/",$_POST['pw1'])){
                            hozaad($_POST['uname'],$_POST['e'],$_POST['pw1']);
                            $_SESSION['uname'] = $_POST['uname'];
                            $_SESSION['e']=$_POST['e'];
                            header("Location: index.php");
                        }else{
                            header("Location: index.php?hiba=register_pw");
                        }
                    }else{
                        header("Location: index.php?hiba=register_pw_nomatch");
                    }
                }else{
                    header("Location: index.php?hiba=register_uname");
                }
            }else{
                header("Location: index.php?hiba=register_e");
            }
        }else{
            header("Location: index.php?hiba=register_letezik");
        }
    }else{
        header("Location: index.php");
    }

    function validEmail($cim){
        return "/^[^\s@]+@[^\s@]+\.[^\s@]+$/".test($cim);
    }
?> 