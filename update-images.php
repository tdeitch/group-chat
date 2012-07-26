<?php
    $json_string = file_get_contents($_SERVER['NFSN_SITE_ROOT']."protected/info.json");
    $info = json_decode($json_string,true);
    $people = $info["people"];
    $profiles = $info["profiles"];

    foreach ($people as $to => $name) {
        file_put_contents("images/".$name.".jpg", file_get_contents("http://graph.facebook.com/".$profiles[$to]."/picture?type=large"));
    }
?>