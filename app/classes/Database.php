<?php

namespace App\classes;

class Database {
    function dbConnection(){
        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $database = "omss";
        $link = mysqli_connect($hostName, $userName, $password, $database);
        return $link;
    }

}