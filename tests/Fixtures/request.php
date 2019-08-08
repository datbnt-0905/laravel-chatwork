<?php

$body = [
    "webhook_setting_id" => "12345",
    "webhook_event_type" => "mention_to_me",
    "webhook_event_time" => 1498028130,
    "webhook_event" => [
        "from_account_id" => 123456,
        "to_account_id" => 1484814,
        "room_id" => 567890123,
        "message_id" => "789012345",
        "body" => "[To=>1484814]Okazu là gì?",
        "send_time" => 1498028125,
        "update_time" => 0,
    ],
];

return json_encode($body, true);
