<?php

    ## Yu Du

    # Set up PHP to report all errors
    error_reporting(E_ALL);
    
    # Variables for connections to the database.
    $host =  'localhost'; #fill in with server name
    $dbname = 'dubshot';    #fill in with db name
    $user = 'root';       #fill in with user name
    $password = '';       #fill in with password
    
    # Make a data source string that will be used in creating the PDO object
    $ds = "mysql:host={$host};dbname={$dbname};charset=utf8";
    # connect to the Pokedex database and set some attributes
    try {
        $db = new PDO($ds, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $ex) {
        header("Content-Type: text/plain");
    	print ("Can not connect to the database. Please try again later.\n");
    	print ("Error details: $ex \n");
    	die();
    }
    
    header("Content-Type: application/json");
    
    function reportMissingParam() {
        header("HTTP/1.1 400 Invalid Request");
        print(json_encode(Array("error"=>"Please fill up all the info.")));
    }
    
    function delete($db, $emailAddress) {
        $sql = "DELETE FROM Dubshot WHERE emailAddress LIKE '%{$emailAddress}%'";
        $db->exec($sql);
        print(json_encode(Array("success"=>"Success! You are removed!")));
    }
    
    function insert($FirstName, $LastName, $db, $emailAddress, $portfolioLink) {
        $sql = "INSERT INTO Dubshot (FirstName, LastName, emailAddress, portfolioLink) VALUES (:FirstName, :LastName, :emailAddress, :portfolioLink)";
        $stmt = $db->prepare($sql);
        $params = array(":FirstName" => $FirstName, ":LastName" => $LastName, ":emailAddress" => $emailAddress, ":portfolioLink" => $portfolioLink);
        $stmt->execute($params);
        print(json_encode(Array("success"=>"Success! $FirstName 's application added!")));
        
    }
  
    function userExists($emailAddress, $db) {
        $sql = "SELECT count(*) FROM Dubshot WHERE name='$emailAddress'";
        $rows = $db->query($sql);
        $count = $rows->fetchColumn();
        if ($count == 0) {
            return false;
        } else {
            return true;
        }
    }

    function reportError() {
        header("HTTP/1.1 400 Invalid Request");
        print(json_encode(Array("error"=>"Error: User not found.")));
    }
?>