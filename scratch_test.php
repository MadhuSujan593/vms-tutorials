<?php
require 'vendor/autoload.php';
$text = "`6` and `12`";
echo \Illuminate\Support\Str::markdown($text, ['html_input' => 'allow']);
