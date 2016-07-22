<?php
namespace Pack\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Escape helper
 */
class PackHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'namespace' => 'Pack',
        'variables' => []
    ];

    /**
     * blocks.
     *
     * @var array
     */
    private $blocks = [
        'javascriptstart' => '<script>',
        'javascriptend'   => '</script>',
    ];

    /**
     * render
     */
    public function render()
    {
        $scripts = '';
        $config = $this->config();

        if (empty($config['variables'])) {
            return $scripts;
        }

        $scripts .= $this->blocks['javascriptstart'];

        $scripts  .= $this->renderWrap($config['namespace']);

        $scripts  .= $this->renderVariables($config['namespace'], $config['variables']);

        $scripts .= $this->blocks['javascriptend'];

        return $scripts;
    }

    /**
     * renderWrap
     */
    private function renderWrap($namespace)
    {
        return "window.{$namespace}={};";
    }

    /**
     * renderVariables
     */
    private function renderVariables($namespace, $variables)
    {
        $jsVars = '';

        foreach ($variables as $key => $var) {
            $jsVars .= "{$namespace}.{$key} = {$var[0]};";
        }

        return $jsVars;
    }
}
