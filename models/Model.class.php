<?php

/**
 * CONFIGURATION DE LA BASE DE DONNEES à dans le fichier config
 * -----------------------------------
 * Ca facilite l'évolution, le jour où on change de base de données ou que l'utilisateur
 * ou que le mot de passe change, on peut simplement modifier ce fichier
 * 
 * host = "localhost";
 * dbname = "biblio";
 * dbusername = "root";
 * password = "";
 */
/**
 * Classe abstraite représentant toutes les intéractions possibles avec une table :
 *
 * On ne veut pas qu'un développeur puisse se dire "Tiens, je vais créer un objet de la classe Model", ça ne veut rien dire car le Model de base ne sait pas à quelle table il s'intéresse.
 *
 * On obligera donc le développeur à hériter de cette classe et à préciser le nom de la table concernée !
 *
 * Pour préciser, il faudra que la classe enfant (par exemple StatusModel) définisse bien la propriété : protected $table = "status"
 *
 * LES PROPRIETES :
 * -----------------
 * - $db est un objet de la classe PDO qui représente la connexion à la base de données
 * - $table  est une chaine de caractère qui indique au model à quelle table il s'intéresse !
 *
 * LES METHODES :
 * -----------------
 * - findAll() : selection de toutes les lignes de la table
 * - find($id) : selection d'une seule ligne via l'identifiant
 * - insert($array) : insertion d'une nouvelle ligne dans la table
 * - update($array) : mise à jour d'une ligne dans la table
 * - delete($id) : suppression d'une ligne dans la table grâce à son identifiant
 */

abstract class Model{
    private static $pdo;

    private static function setBdd(){
        self::$pdo = new PDO("mysql:host=localhost;dbname=biblio;charset=utf8","root","");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
}