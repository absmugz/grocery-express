<?php

use Twilio\Rest\Client;

function twilio() {
return new Client(
config('twilio.account_sid'),
config('twilio.auth_token')
);
}
