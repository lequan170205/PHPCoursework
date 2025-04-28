<?php
require 'vendor/autoload.php';
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
Configuration::instance([
    'cloud' => [
        'cloud_name' => 'dwczo5jpk',
        'api_key' => '417323495343428',
        'api_secret' => '9TtX3XWkvPC9WZ5pwcH4O58PaoM'
    ],
    'url' => ['secure' => true]
]);
?>