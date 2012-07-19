<?php

    // make an associative array of numbers to people.
    $json_string = file_get_contents("numbers.json");
    $people = json_decode($json_string,true);

    if ($people[$_REQUEST['From']]) { 
        echo "<Response>";
        echo"<Say>Hello, ".$people[$_REQUEST['From']]."</Say>";
        echo "<Dial>";
        echo "<Conference waitUrl='maybe.mp3'>Room</Conference>";
        echo "</Dial>";
        echo "</Response>";
    }
    else {
        echo "<Response>";
        echo "</Response>";
    }

?>
