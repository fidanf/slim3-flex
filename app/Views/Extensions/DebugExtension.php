<?php

namespace App\Views\Extensions;

class DebugExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'dump', [$this, 'dump'],
                ['needs_context' => true, 'needs_environment' => true]
            ),
        ];
    }
    /**
     * @param $var
     * @return mixed
     */
    public function dump($env, $context, ...$vars)
    {
        if (!$env->isDebug())
        {
            return;
        }

        if (!$vars) {
            $vars = array();
            foreach ($context as $key => $value) {
                if (!$value instanceof Twig_Template) {
                    $vars[$key] = $value;
                }
            }
            dump($vars);
        } else {
            dump($vars);
        }

    }
}