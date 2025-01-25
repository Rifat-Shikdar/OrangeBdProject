<?php

return [
    'paths' => ['api/*'], // Apply CORS to API routes
    'allowed_methods' => ['*'], // Allow all HTTP methods
    'allowed_origins' => ['*'], // Allow all origins, or specify specific origins
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
