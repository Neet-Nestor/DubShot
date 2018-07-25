
<?php

    ## Yu Du
    include('common.php');
    
    ## Code to check the POST parameters
    if (isset($_POST["emailAddress"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["PortfolioLink"])) {
        $ea = $_POST["emaillAddress"];
        $fn = $_POST["FirstName"];
        $ln = $_POST["LastName"];
        $pl = $_POST["PortfolioLink"]
        if (!userExists($ea, $db)) {
            insert($fn, $ln, $db, $ea, $pl);
        } else {
            header("HTTP/1.1 400 Invalid Request");
            print(json_encode(Array("error"=>$error = "Error: User $fn exists.")));
        }
    } else {
        reportMissingParam();
    }
?>