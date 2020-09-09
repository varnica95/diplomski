<?php

return [
    "mysql" => [
        "host" => "localhost",
        "database" => "diplomski",
        "username" => "root",
        "password" => "secret"
    ],

    "rememberme" => [
        "cookie_name" => "hash",
        "cookie_expiry" => 604800
    ],

    "azure" => [
        "url" => "https://ussouthcentral.services.azureml.net/workspaces/41b329e8ef0a43318ccdfcbbb3bd2019/services/81e1935857de484cb2f7fcf90662701b/execute?api-version=2.0&details=true",
        "header" => [
            "Authorization: Bearer Qs/0gDydgJGrELzauNxO90KLo0Fu4bGNwFJV5YJwDtvgQ/87NTBDx5amukGmte3s+gxib/cyLrnRKHOrAmHSzA==",
            "Content-Type: application/json"
        ]
    ]
];