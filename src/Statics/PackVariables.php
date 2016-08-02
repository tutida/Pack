<?php

namespace Pack\Statics;

/**
 * Pack Variables
 */
class PackVariables
{
    private static $variables = [];

    /**
     * set
     */
    public function set($varName, $data = null)
    {
        self::$variables[$varName] = [$data];
    }

    /**
     * remove
     */
    public function remove($varName)
    {
        unset(self::$variables[$varName]);
    }

    /**
     * get
     */
    public function get($varName = null)
    {
        if (!isset(self::$variables[$varName])) {
            return null;
        }

        return self::$variables[$varName];
    }

    /**
     * getAll
     */
    public function getAll()
    {
        return self::$variables;
    }

}
