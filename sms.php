<?php
    require "Services/Twilio.php";

    $json_string = file_get_contents($_SERVER['NFSN_SITE_ROOT']."protected/info.json");
    $info = json_decode($json_string,true);
    $AccountSid = $info["AccountSid"];
    $AuthToken = $info["AuthToken"];
    $client = new Services_Twilio($AccountSid, $AuthToken);
    $from = $info["from"];
    $people = $info["people"];
    $profiles = $info["profiles"];

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

    $fh = fopen($_SERVER['NFSN_SITE_ROOT']."protected/log.php", 'a');
    $stringData = "<tr><td class=\"author\"><img src=\"images/".$people[$_REQUEST['From']].".jpg\"><br>".$people[$_REQUEST['From']]."</td><td class=\"message-text\">".stripslashes($_REQUEST['Body'])."<div class=\"date\">".date('D, d M Y H:i:s')." UTC</div></td></tr>\n";
    fwrite($fh, $stringData);
    fclose($fh);

    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>

<Response>
</Response>
