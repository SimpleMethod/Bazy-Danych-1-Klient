<?php
/**
 * Created by PhpStorm.
 * User: Pathfinder
 * Date: 18.01.2018
 * Time: 17:53
 */
error_reporting(0);












require ('./ApiDataBase.php');
$zapytanie = new ApiDataBase();

$a = $_POST["sql"];
if (empty($_POST["json"])) {
$b=0;
}
else
{
    $b=1;

}
if($_POST["json"]==2)
{
    $zapytanie->ExecAlternativeSQL($a,htmlspecialchars(0));
}
if (preg_match("/\W*((?i)select(?-i))\W*/", $a)){
    $zapytanie->ExecSQL(($a),htmlspecialchars($b));
}
else
{
   $zapytanie->ExecAlternativeSQL(($a),htmlspecialchars($b));
}


