Group Chat
==========

This repo provides PHP programs to run a Twilio group chat and conference room.

info.json
---------

The info.json file should have the following format:

    {
        "AccountSid": "sfvnjssfvojnsfjnvvdsnjofvjnofe",
        "AuthToken": "kbsevjbsefnjvidsfonjvsfnjovndjof",
        "Password": "SHA512HASHOFPASSWORD",
        "from": "+19095551234",
        "GroupName": "Our Fun Group!",
        "ConferenceRoom": "FunRoom",
        "LogFile": "log.html",
        "people": {
            "+17155554859": "Alice",
            "+14635559275": "Bob",
            "+13835558492": "Charles",
            "+19475554719": "Dasiy"
        },
        "profiles": {
            "+17155554859": "alice",
            "+14635559275": "bsmith",
            "+13835558492": "charleydickens",
            "+19475554719": "daisymae"
        }
    }
