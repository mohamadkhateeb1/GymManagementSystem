<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | هذا الإعداد يسمح لتطبيق فلاتر (يعمل من منفذ/عنوان مختلف عن الموقع)
    | بالوصول لكل من الـ API وملفات storage العامة (صور الوجبات والتمارين).
    | القيمة '*' بالتطوير فقط — عند النشر الفعلي يجب تحديد نطاقات محددة.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'storage/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];