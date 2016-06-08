<?php

class Bdd
{
    private static $connect = null;
    private $bdd;

    private function __construct()
    {
        $strBddServer = "DatabaseIP";
        $strBddLogin = "DatabaseLogin";
        $strBddPassword = "DatabasePass";
        $strBddBase = "DatabaseName";


        //Création d'un lien à la base de données de type PDO
        try{
            $this->bdd = new PDO('mysql:host='.$strBddServer.';dbname='.$strBddBase,$strBddLogin,$strBddPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }

    public static function getInstance() {
        if(is_null(self::$connect)) {
            self::$connect = new Bdd();
        }
        return self::$connect;
    }

    public function preparation($req){
        $query = $this->bdd->prepare($req);
        return $query;
    }

    public function execution($query, $tab){
        $req = $query->execute($tab);
        return $req;
    }

}