<?php
namespace Pack\Controller\Component;

use Pack\Statics\PackVariables;
use Cake\Event\Event;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Pack component
 */
class PackComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'namespace' => 'Pack'
    ];

    /**
     * beforeRender
     */
    public function beforeRender(Event $event)
    {
        $namespace = $this->config('namespace');

        $variables = PackVariables::getAll();

        $event->subject->helpers += ['Pack.Pack' => ['namespace' => $namespace]];
    }

    /**
     * rename
     */
    public function rename($namespace = null)
    {
        $this->config('namespace', $namespace);
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
        $namespace = $this->config('namespace');

        $variable = PackVariables::get($varName);

        if (!is_null($variable)) {
            PackVariables::remove($varName);

            return true;
        }

        return false;
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
        $namespace = $this->config('namespace');

        $data = $this->json_safe_encode($data);

        PackVariables::set($varName, $data);
    }


    /**
     * json_safe_encode
     */
    private function json_safe_encode($data)
    {
        return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
}
