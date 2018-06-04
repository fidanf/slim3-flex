<?php

namespace App\Views\Extensions;

class DumpExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('dump', [$this, 'dump']),
        ];
    }
    /**
     * @param $var
     * @return mixed
     */
    public function dump($var)
    {
        return dump($var);
    }
}