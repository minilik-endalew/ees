<?php

class DBConnection {
    public function __construct(){}
    public function connect_old()
    {
        
        $server = "localhost";
        $username = "root";
        $password = "";
		
        $connection = mysql_connect($server, $username, $password,"ees")or die("connection error ".mysqli_error($link));
		mysql_select_db("aau",$connection) or die("DB Selection Error: ".mysqli_error($link));
        return $connection;
    }
    public function connect()
    {
        global $link;
        $link= mysqli_connect("localhost", "root", "", "aau");

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        /* return name of current default database */


        /* change db to world db */
        mysqli_select_db($link, "aau");


        //mysqli_close($link);
        //return $link;

    }

    public  function executeQuery($query)
    {
        /*$dbConnection = DBConnection::connect();
        mysql_select_db("aau", $dbConnection);
        $result = mysqli_query($link,$query);
        return $result;*/
        $dbConnection=DBConnection::connect_mysqli();
    }

    public  function readFromDatabase($query)/*returns the records read from the database*/
    {    	  
        //$result = DBConnection::executeQuery($query);
        //return $result;
    }
}//end class
?>
