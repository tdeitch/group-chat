<?php
    // make an associative array of server admins. Feel free to change/add your 
    // own phone number and name here.

    $json_string = file_get_contents($_SERVER['NFSN_SITE_ROOT']."protected/info.json");
    $info = json_decode($json_string,true);
    $people = $info["people"];
 
    if ($people[$_REQUEST['From']]) { 
        echo "<Response>";
        echo"<Say>Hello, ".$people[$_REQUEST['From']]."</Say>";
        echo "<Dial>";
        echo "<Conference>".$info["conferenceroom"]."</Conference>";
        echo "</Dial>";
        echo "</Response>";
    }
    else {
        echo "<Response>"
        echo "</Response>"
    }
?>
