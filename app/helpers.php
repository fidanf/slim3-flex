<?php

use Symfony\Component\VarDumper\{
    VarDumper, Dumper\HtmlDumper, Dumper\CliDumper, Cloner\VarCloner
};

VarDumper::setHandler(function ($var) {
    $cloner = new VarCloner;
    $htmlDumper = new HtmlDumper;
    
    $htmlDumper->setStyles([
        'default' => 'background-color:#f6f6f6; color:#222; line-height:1.3em; 
            font-weight:normal; font:16px Monaco, Consolas, monospace; 
            word-wrap: break-word; white-space: pre-wrap; position:relative; 
            z-index:100000',
        'public' => 'color:#ec9114',
        'protected' => 'color:#ec9114',
        'private' => 'color:#ec9114',
    ]);
    $dumper = PHP_SAPI === 'cli' ? new CliDumper : $htmlDumper;
    $dumper->dump($cloner->cloneVar($var));
});

if (!function_exists('base_path')) {
    function base_path($path = '') {
        return __DIR__ . '/..//' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('env')) {
    function env($key, $default = null) {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case $value === 'true';
                return true;
            case $value === 'false';
                return false;
            default:
                return $value;
        }
    }
}

if (!function_exists('debug')) {
    function debug()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }
}