<?
/************************************************************\
*
*       PHP Pass Copyright 2005 Howard Yeend
*       www.puremango.co.uk
*
*    This file is part of PHP Pass.
*
*    PHP Pass is free software; you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation; either version 2 of the License, or
*    (at your option) any later version.
*
*    PHP Pass is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with PHP Pass; if not, write to the Free Software
*    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*
*
\************************************************************/

session_start();

//--------------------------
// user definable variables:
//--------------------------

// maximum number of seconds user can remain idle without having to re-login:
// use a value of zero for no timeout
$max_session_time = 28800;

// type of alert to give on incorrect password:
// eg:
// $alert = "joe@foo.com";  - sends email to joe@foo.com
// $alert = "blah";     - appends to file named 'blah'
// $alert = "";         - no alerts
$alert = "";

// acceptable passwords:
$cmp_pass = Array();
$cmp_pass[] = "";

// maximum number of bad logins before user locked out
// use a value of zero for no hammering protection
$max_attempts = 5;

//-----------------------------
// end user definable variables
//-----------------------------

// save session expiry time for later comparision
$session_expires = $_SESSION['mpass_session_expires'];

// have to do this otherwise max_attempts is actually one less than what you specify.
$max_attempts++;

if(!empty($_POST['mpass_pass']))
{
    // store md5'ed password
    $_SESSION['mpass_pass'] = md5($_POST['mpass_pass']);
}

if(empty($_SESSION['mpass_attempts']))
{
    $_SESSION['mpass_attempts'] = 0;
}

// if the session has expired, or the password is incorrect, show login page:
if(($max_session_time>0 && !empty($session_expires) && mktime()>$session_expires) || empty($_SESSION['mpass_pass']) || !in_array($_SESSION['mpass_pass'],$cmp_pass))
{
    if(!empty($alert) && !in_array($_SESSION['mpass_pass'],$cmp_pass))
    {
        // user has submitted incorrect password
        // generate alert:

        $_SESSION['mpass_attempts']++;

        $alert_str = $_SERVER['REMOTE_ADDR']." entered ".htmlspecialchars($_POST['mpass_pass'])." on page ".$_SERVER['PHP_SELF']." on ".date("l dS of F Y h:i:s A")."\r\n";

        if(stristr($alert,"@")!==false)
        {
            // email alert
            @mail($alert,"Bad Login on ".$_SERVER['PHP_SELF'],$alert_str,"From: ".$alert);
        } else {
            // textfile alert
            $handle = @fopen($alert,'a');
            if($handle)
            {
                fwrite($handle,$alert_str);
                fclose($handle);
            }
        }
    }
    // if hammering protection is enabled, lock user out if they've reached the maximum
    if($max_attempts>1 && $_SESSION['mpass_attempts']>=$max_attempts)
    {
        exit("Too many login failures.");
    }


    // clear session expiry time
    $_SESSION['mpass_session_expires'] = "";

    ?>
<!DOCTYPE HTML>
<html lang=en>
<head>
<meta charset=utf-8>
<title>Group Chat</title>
<style type="text/css">
body {
    font-family: "Helvetica Neue", "Helvetica", sans-serif;
    font-size: 11pt;
    word-wrap: break-word;
}
#content {
    width: 510px;
    margin: 50px auto 20px auto;
    padding: 0;
}
</style>
</head>
<body>
<div id="content">
<h1>Group Chat</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
<p><center>
Please log in to continue:<br>
<input type="password" name="mpass_pass">
<input type="submit" value="Login"></center></p>
</form>
</div>
</body>
</html>
    <?

    // and exit
    exit();
}

// if they've got this far, they've entered the correct password:

// reset attempts
$_SESSION['mpass_attempts'] = 0;

// update session expiry time
$_SESSION['mpass_session_expires'] = mktime()+$max_session_time;

// end password protection code
?>
<!DOCTYPE HTML>
<html lang=en>
<head>
<meta charset=utf-8>
<title>Group Chat</title>
<style type="text/css">
body {
    font-family: "Helvetica Neue", "Helvetica", sans-serif;
    font-size: 11pt;
    word-wrap: break-word;
}
#content {
    width: 510px;
    margin: 50px auto 20px auto;
    padding: 0;
}
td {
    min-width: 100px;
    max-width: 400px;
    padding-bottom: 28pt;
}
.author {
    font-size: 12pt;
    text-align: center;
}
.date {
    color: #666;
    padding-top: 6pt;
}
img {
    max-width: 64px;
}
</style>
</head>
<body>
<div id="content">
<h1>Group Chat</h1>
<table>
<?
include $_SERVER['NFSN_SITE_ROOT']."protected/log.php"
?>
</table>
</div>
</body>
</html>
<? // update facebook images
include $_SERVER['NFSN_SITE_ROOT']."public/update-images.php"
?>