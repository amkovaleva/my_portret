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
        'frames' =>[ 'format', 'frame', 'mount'],
        'order' => ['price','addon', 'count-face', 'delivery-type','pay-type', 'cancel-reason']
    ),
    'portrait_types' => [
        1 =>['stars' => 5, 'key' => 'hyperrealism', 5, 'bg_image' => '/images/store/background_hyperrealism.jpg'],
        2 => ['stars' => 4, 'key' => 'photorealism', 'bg_image' => '/images/store/background_photorealism.jpg'],
        3 => ['stars' => 3, 'key' => 'sketch', 'bg_image' => '/images/store/background_sketch.jpg']],

];
