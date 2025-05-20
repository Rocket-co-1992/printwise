<?php

return [
    'app_name' => 'Print Calculator',
    'app_version' => '1.0.0',
    'debug' => true,
    'base_url' => 'http://localhost/print-calculator/public',
    'timezone' => 'America/Sao_Paulo',
    'locale' => 'pt_BR',
    'env' => [
        'DB_HOST' => 'localhost',
        'DB_USERNAME' => 'your_username',
        'DB_PASSWORD' => 'your_password',
        'DB_NAME' => 'print_calculator',
        'APP_KEY' => 'base64:your_app_key',
    ],
    'constants' => [
        'ADMIN_ROLE' => 'admin',
        'OPERATOR_ROLE' => 'operator',
    ],
];