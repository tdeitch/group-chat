Group Chat
==========

This repo provides PHP programs to run a Twilio group chat and conference room.

Install
-------

1. Sign up for Twilio
2. Copy everything in this repo to your web server
3. Move info.json.example to info.json and fill in the fields (see below)
4. If you're not using NearlyFreeSpeech.net, update call.php, index.php, pass.php, sms.php, and update-images.php to use the correct paths. The scripts are written for NearlyFreeSpeech.net, so they use the variable `$_SERVER['NFSN_SITE_ROOT'].` Search for that and replace those paths with your actual paths.
5. Be sure wherever you store the message log is locked down.

info.json
---------

The info.json file should have the following format:

    {
        "AccountSid": "sfvnjssfvojnsfjnvvdsnjofvjnofe",
        "AuthToken": "kbsevjbsefnjvidsfonjvsfnjovndjof",
        "From": "+19095551234",
        "password": "SHA512HASHOFPASSWORD",
        "groupname": "Our Fun Group!",
        "conferenceroom": "FunRoom",
        "logfile": "protected/log.php",
        "people": {
            "+17155554859": "Alice",
            "+14635559275": "Bob",
            "+13835558492": "Charles",
            "+19475554719": "Dasiy"
        },
        "profiles": {
            "Alice": "alice",
            "Bob": "bsmith",
            "Charles": "charleydickens",
            "Daisy": "daisymae"
        }
    }
    
- AccountSid and AuthToken are from Twilio
- From is your Twilio phone number
- Password is SHA-512 hash of the password used to log in to the web chat logs
- groupname is the name used as the title of the web chat logs
- conferenceroom is the name of the Twilio voice conference room
- logfile is where SMS messages are stored
- people is an array of the phone numbers and names of the people in the SMS group
- profiles is an array of names and Facebook usernames of the people in the SMS group, used to display profile pictures in the web SMS logs
