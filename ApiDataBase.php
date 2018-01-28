<?php
/**
 * Created by PhpStorm.
 * User: Pathfinder
 * Date: 17.01.2018
 * Time: 23:25
 */

/**
 * Class ApiDataBase
 *
 * Sposób użycia:
 * Dla Select - ExecSQL
 * Dla reszty (Sprawdzenie poprawnosci wykoania polecenia) - ExecAlternativeSQL
 */

error_reporting(0);

class ApiDataBase
{

    private $conn;
    private $json;

    function __construct() {
        $ini = parse_ini_file('app.ini');
        $this->conn = oci_connect($ini[username], $ini[password], $ini[connection_string],'AL32UTF8');
        if (!$this->conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }
    function ExecSQL($inquiry,$enableJson)
    {
        $this->json= array();
        $stid = oci_parse($this->conn, $inquiry);
        if (!$stid) {
            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $r = oci_execute($stid);
        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        if($enableJson==0)
        {
            print "<table border='1'>\n";
            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS+OCI_FETCHSTATEMENT_BY_ROW)) {
                print "<tr>\n";
                foreach ($row as $item) {
                    print "    <td>" . $item. "</td>\n";
                }
                print "</tr>\n";
            }
            print "</table>\n";
        }
        else
        {
            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS+OCI_FETCHSTATEMENT_BY_ROW)) {
                $this->json[]=$row;
            }
           header('Content-Type: application/json');
         echo (json_encode( $this->json,JSON_UNESCAPED_UNICODE ));
        }
        oci_free_statement($stid);
    }

    function ExecAlternativeSQL($inquiry,$enableJson)
    {

        $messageError =array();
        $stid = oci_parse($this->conn, $inquiry);
        $r = oci_execute($stid);
        if (!$r) {
            $e = oci_error($stid);
            $messageError[0]["status"]='ERROR';
            $messageError[0]["message"]=$e['message'];
            $messageError[0]["sqltext"]=$e['sqltext'];
        }
        else
        {
            $messageError[0]["status"]='OK';
            $messageError[0]["message"]='Brak błedu';
            $messageError[0]["sqltext"]='Brak błedu';
        }
        if($enableJson==0) {
            print htmlentities($messageError[0]);
            print "\n<pre>\n";
            print htmlentities($messageError[1]);
            print  "\n</pre>\n";
        }
        else
        {
            header('Content-Type: application/json');
            echo json_encode($messageError,JSON_UNESCAPED_UNICODE);
        }

        oci_free_statement($stid);
    }

    public function __destruct()
    {
        oci_close($this->conn);
    }
}