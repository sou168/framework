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
            return str_replace('/', '.', self::fillLangType($name));
        }

        [$namespace, $name] = explode($delimiter, $name);

        return $namespace.$delimiter.str_replace('/', '.', self::fillLangType($name));
    }

    protected static function fillLangType($name)
    {
        if ( (bool)env('MULTI_VIEW')) {
            if ( env('MULTI_LANG') && $_SERVER['LANG']) {
                $name = $_SERVER['LANG']. '.' .$name;
            }
        }

        if ( env('MULTI_CLIENT_TYPE') && $_SERVER['CLIENT_TYPE']) {
            $name .= '.' .$_SERVER['CLIENT_TYPE'];
        }

        return $name;
    }
}
