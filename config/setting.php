<?php

return [
    'db_host' => $_ENV['DB_HOST']     ?? getenv('DB_HOST')     ?? 'localhost',
    'db_port' => $_ENV['DB_PORT']     ?? getenv('DB_PORT')     ?? '8889',
    'db_name' => $_ENV['DB_NAME']     ?? getenv('DB_NAME')     ?? 'vitegourmand',
    'db_user' => $_ENV['DB_USER']     ?? getenv('DB_USER')     ?? 'metamorph',
    'db_pass' => $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '',
];