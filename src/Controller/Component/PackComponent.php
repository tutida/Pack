<?php
namespace Pack\Controller\Component;

use Pack\Statics\PackVariables;
use Cake\Event\Event;
use Cake\Controller\Component;

/**
 * Pack component
 */
class PackComponent extends Component
{
    /**
     * beforeRender
     */
    public function beforeRender(Event $event)
    {
        $event->subject->helpers += ['Pack.Pack'];
    }

    /**
     * set
     */
    public function set($varName, $data = null)
    {
        if (is_array($varName)) {
            foreach ($varName as $key => $data) {
                $this->variableSet($key, $data);
            }
        } else {
            $this->variableSet($varName, $data);
        }
    }

    /**
     * remove
     */
    public function remove($varName)
    {
        $variable = PackVariables::get($varName);

        if (is_null($variable)) {
            return false;
        }

        PackVariables::remove($varName);
        return true;
    }

    /**
     * show
     */
    public function show()
    {
        return PackVariables::getAll();
    }

    /**
     * variableSet
     */
    private function variableSet($varName, $data)
    {
        PackVariables::set($varName, $data);
    }

    /**
     * renameNamespace
     */
    public function renameNamespace($namespace)
    {
        if (empty($namespace)) {
            return false;
        }

        PackVariables::renameNamespace($namespace);
        return true;
    }

    /**
     * getNamespace
     */
    public function getNamespace()
    {
        return PackVariables::getNamespace();
    }

    /**
     * setScriptAttr
     */
    public function setScriptAttr($attr)
    {
        if (empty($attr)) {
            return false;
        }

        PackVariables::setScriptAttr($attr);
        return true;
    }

    /**
     * getScriptAttr
     */
    public function getScriptAttr()
    {
        return PackVariables::getScriptAttr();
    }
}
