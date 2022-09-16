<?php

return [
'APP_GITHUB_TOKEN' => env('APP_GITHUB_TOKEN'),
'GITHUB_HEADERS' => [
     'Accept' => 'application/vnd.github+json',
     'Authorization' => 'token '.env('APP_GITHUB_TOKEN')
],
'GITHUB_URL' => 'https://api.github.com/'
];
