<?php
require_once "bdd.php";


function allInfo()
{
    $req = Bdd::getInstance()->preparation("SELECT id,temp,humidite,plante,date FROM temp");
    $req->execute();
    $req = $req->fetchAll();

    return $req;
}

function chartPlant()
{
    $req = Bdd::getInstance()->preparation("SELECT temp,humidite,plante,date FROM temp ORDER BY date DESC LIMIT 24");
    $req->execute();
    $req = $req->fetchAll();

    return $req;
}