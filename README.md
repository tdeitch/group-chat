Group Chat
==========

This repo provides PHP programs to run a Twilio group chat and conference room.

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
