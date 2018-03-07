<?php
require_once('/../../fonctions.php');

class HelpDataEntry
{

    public function __construct(){}


    public function allTables($nameBdd)
    {
        $bdd = doConnexion();
        $str = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='" . $nameBdd . "' ";
        $query = $bdd['object']->prepare($str);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function columnsFromTable($table,$schema)
    {
        $bdd = doConnexion();
        $str = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table."' AND TABLE_SCHEMA='".$schema."'";
        $query = $bdd['object']->prepare($str);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function showResultsColumns($resultat) {
        echo '<input type="checkbox" id="subscribeNews" name="select" value="*">*<br>';
        foreach($resultat as $r) {
            echo '<input type="checkbox" id="subscribeNews" name="select" value="'.$r['COLUMN_NAME'].'">'.$r['COLUMN_NAME'] .'<br>';
        }
    }
}