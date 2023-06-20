<?php

/**
 * This is config for Infobip SMS.
 *
 * @see https://dev.infobip.com/send-sms/single-sms-message
 */
return [
    'from'     => env('INFOBIP_FROM', 'On My Way Therapy Services'),
    'username' => env('INFOBIP_USERNAME', 'onmyway'),
    'password' => env('INFOBIP_PASSWORD', 'Onmywaytherapy9392!'),
];
