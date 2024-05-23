<?php

// Define Bladekit color theme
$primaryColor = "\033[38;5;74m"; // Green
$accentColor = "\033[38;5;208m"; // Yellow
$reset = "\033[0m";
$bold = "\033[1m";

// Banner message
$banner = <<<BANNER
$primaryColor$bold


     _            _            _    ___     _           _      _    _ _   
  __| | _____   _(_)_ __   ___(_)  / / |__ | | __ _  __| | ___| | _(_) |_ 
 / _` |/ _ \ \ / / | '_ \ / __| | / /| '_ \| |/ _` |/ _` |/ _ \ |/ / | __|
| (_| |  __/\ V /| | | | | (__| |/ / | |_) | | (_| | (_| |  __/   <| | |_ 
 \__,_|\___| \_/ |_|_| |_|\___|_/_/  |_.__/|_|\__,_|\__,_|\___|_|\_\_|\__|


$reset$accentColor$bold
     Devinci Bladekit Package
$reset

Thank you for installing Devinci Bladekit! Here are some quick start instructions:

1. Publish the package assets using the following command:

   $ php artisan vendor:publish --provider=Devinci\\\\Bladekit\\\\BladekitServiceProvider --tag=bladekit-assets

2. Customize the published assets according to your needs.

3. Enjoy using Devinci Bladekit in your Laravel project!

BANNER;

// Output the banner message
echo $banner;
