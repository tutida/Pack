<?php
namespace Pack\Statics;

/**
 * Pack Variables
 */
class PackVariables
{
    private static $variables     = [];
    private static $namespace     = 'Pack';
    private static $scriptAttr    = '';

    /**
     * set
     */
    public static function set($varName, $data)
    {
        self::$variables[$varName] = $data;
    }

    /**
     * remove
     */
    public static function remove($varName)
    {
        unset(self::$variables[$varName]);
    }

    /**
     * get
     */
    public static function get($varName)
    {
        if (!isset(self::$variables[$varName])) {
            return null;
        }

        return self::$variables[$varName];
    }

    /**
     * getAll
     */
    public static function getAll()
    {
        return self::$variables;
    }

    /**
     * renameNamespace
     */
    public static function renameNamespace($namespace)
    {
        self::$namespace = $namespace;
    }

    /**
     * getNamespace
     */
    public static function getNamespace()
    {
        return self::$namespace;
    }

    /**
     * setScriptAttr
     */
    public static function setScriptAttr($scriptAttr)
    {
        self::$scriptAttr = $scriptAttr;
    }

    /**
     * getScriptAttr
     */
    public static function getScriptAttr()
    {
        return self::$scriptAttr;
    }
}
