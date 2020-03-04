<?php
namespace projetfour\model;
use \PDO as PDO;
    class Manager
    {
       function dbConnect()
        {
            $db = new PDO('mysql:host=db725315045.db.1and1.com;dbname=db725315045;charset=utf8', 'dbo725315045', 'rUEMu72CtVii9vv&', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $db;
        }
    }