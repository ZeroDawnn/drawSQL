<?php
require_once('../../application/forms/From.php');
require_once('../../application/forms/Where.php');
require_once('../../application/forms/ExecutionQuery.php');
require_once('../../application/forms/Select.php');
require_once('../../application/forms/HelpDataEntry.php');

$select=null;
$from=null;

if (isset($_POST['fromInput'])) {
    $help = new HelpDataEntry();
    $fromSelect = $_POST['fromInput'];
    $select = $help->columnsFromTable($fromSelect, $_SESSION['bdd']);
    $help->showResultsColumns($select);
}

if(isset($_POST['select'])){
    if($_POST['select']){
        $select = new Select("".$_POST['select']."");
        $_SESSION['select'] = serialize($select);
        var_dump($select);
        echo true;
    }else{
        echo false;
    }
}
if(isset($_POST['from'])){
    if($_POST['from']){
        $from = new From("".$_POST['from']."");
        $_SESSION['from'] = serialize($from);
        var_dump($from);
        echo true;
    }else{
        echo false;
    }
}

if(isset($_POST['generer'])){
    if($_POST['generer']){
        if(isset($_SESSION['select']) && isset($_SESSION['from'])){
            echo true;
        }
    }
}
if(isset($_POST['modal'])) {
    if ($_POST['modal']) {
        $select = unserialize($_SESSION['select']);
        $from = unserialize($_SESSION['from']);

        $tabSelect = $select->convertToSQL();
        $tabFrom = $from->convertToSQL();

        $myObj->select = $tabSelect;
        $myObj->from = $tabFrom;

        $myJson = json_encode($myObj);

        echo $myJson;
    }
}
if(isset($_POST['result'])){
    if($_POST['result']){
        $select = unserialize($_SESSION['select']);
        $from = unserialize($_SESSION['from']);


        $tabSelect = $select->convertToSQL();
        $tabFrom = $from->convertToSQL();


        $execution = new ExecutionQuery($tabSelect, $tabFrom);
        $column = $execution->searchNameColumn($from->getTable());
        $execution->showResults($execution->exec(), $column);
    }
}