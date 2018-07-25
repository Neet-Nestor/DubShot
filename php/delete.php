
<?php
    ## Yu Du
    ## 
    
    include('common.php');
    
    ## Code to check the POST parameters
    if (isset($_POST["emailAddress"])) {
        $ea = $_POST["emailAddress"];
        if (userExists($ea, $db)) {
            delete($ea, $db);
        } else {
            reportError();
        }
    } else {
        reportMissingParam();
    }
?>