<?php

namespace Illuminate\View;

class ViewName
{
    /**
     * Normalize the given view name.
     *
     * @param  string  $name
     * @return string
     */
    public static function normalize($name)
    {
        $delimiter = ViewFinderInterface::HINT_PATH_DELIMITER;

        if (! str_contains($name, $delimiter)) {
            return str_replace('/', '.', $name);
        }

        [$namespace, $name] = explode($delimiter, $name);
        if ($_SERVER['MULTI_VIEW'] && strtolower($_SERVER['MULTI_VIEW']) != 'false') {
            if ($_SERVER['MULTI_LANG'] && $_SERVER['LANG']) {
                $name = $_SERVER['LANG']. '.' .$name;
            }
        }
        if ($_SERVER['MULTI_CLIENT_TYPE'] && $_SERVER['CLIENT_TYPE']) {
            $name .= '.' .$_SERVER['CLIENT_TYPE'];
        }

        return $namespace.$delimiter.str_replace('/', '.', $name);
    }
}
