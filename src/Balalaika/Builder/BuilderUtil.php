<?php

namespace Balalaika\Builder;

class BuilderUtil
{
    public static function getMetaName($namespace, $replace, $instance)
    {
        $base_name = str_replace(array($namespace, '\\', $replace), '', get_class($instance));
        return self::splitName($base_name);
    }

    public static function nameToSentence($name, $replace)
    {
        $base_name = str_replace($replace, '', $name);
        return self::splitName($base_name);
    }

    public static function splitName($name)
    {
        $splitted = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
        return join($splitted, ' ');
    }
}

