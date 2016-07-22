<?php
namespace Pack\Controller\Component;

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
     * set variables
     *
     * @var array
     */
    private $variables = [];

    /**
     * controller object
     *
     * @var Cake\Controller\Controller
     */
    private $controller;

    /**
     * Initialize properties.
     */
    public function initialize(array $config)
    {
        $this->controller = $this->_registry->getController();
    }

    /**
     * beforeRender
     */
    public function beforeRender(Event $event)
    {
        $namespace = $this->config('namespace');

        $variables = [];
        if (isset($this->variables[$namespace])) {
            $variables = $this->variables[$namespace];
        }

        $event->subject->helpers += [
            'Pack.Pack' => [
                'namespace' => $namespace,
                'variables' => $variables,
            ]
        ];
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
     * unset
     */
    public function remove($varName)
    {
        $namespace = $this->config('namespace');

        if (isset($this->variables[$namespace][$varName])) {
            unset($this->variables[$namespace][$varName]);

            return true;
        }
        return false;
    }

    /**
     * show
     */
    public function show()
    {
        return $this->variables;
    }

    /**
     * variableSet
     */
    private function variableSet($varName, $data)
    {
        $namespace = $this->config('namespace');

        $data = $this->json_safe_encode($data);

        $this->variables[$namespace][$varName] = [$data];
    }


    /**
     * json_safe_encode
     */
    private function json_safe_encode($data)
    {
        return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
}
