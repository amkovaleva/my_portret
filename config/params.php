<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'prices_by_default' => [7, 16, 21],
    'days_for_cart' => 30,
    'max_side_preview_img' => 300,
    'cookie_name' => 'user_cookie',
    'admin_models' => array(
        'base' => [ 'colour',  'background-colour', 'background-material', 'paint-material', 'portrait-type'],
        'frames' =>[ 'format', 'frame', 'mount',],
        'order' => ['price', 'count-face', 'delivery-type','pay-type', 'cancel-reason']
    ),
];
