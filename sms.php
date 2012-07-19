<?php
    require "Services/Twilio.php";
 
    // make an associative array of numbers to people.
    $json_string = file_get_contents("info.json");
    $info = json_decode($json_string,true);
 
    // Set our AccountSid and AuthToken from twilio.com/user/account
    $AccountSid = info["AccountSid"];
    $AuthToken = info["AuthToken"];

    // Instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    /* Your Twilio Number or Outgoing Caller ID */
    $from = info["from"];

    $people = info["people"]

    $message = stripslashes($_REQUEST['Body']);
    $chunks = explode("||||",wordwrap($message,145,"||||"));

    if ($people[$_REQUEST['From']]) { 
        foreach ($people as $to => $name) {
            if ($to != $_REQUEST['From']) {
                // Send a new outgoing SMS */
                foreach($chunks as $page => $chunk) {
                    $body = $people[$_REQUEST['From']].": ".$chunk;
                    $client->account->sms_messages->create($from, $to, $body);
                }
            }
        }
    }

    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>

<Response>
</Response>
