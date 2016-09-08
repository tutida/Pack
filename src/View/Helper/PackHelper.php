<?php
namespace Pack\View\Helper;

use Pack\Statics\PackVariables;
use Cake\View\Helper;
use Cake\View\StringTemplateTrait;

/**
 * Pack helper
 */
class PackHelper extends Helper
{
    use StringTemplateTrait;

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'templates' => [
            'script' => '<script {{attr}}>window.{{namespace}}={};{{variables}}</script>'
        ],
    ];

    /**
     * render
     */
    public function render()
    {
        $variables = PackVariables::getAll();
        if (empty($variables)) {
            return;
        }

        $namespace = PackVariables::getNamespace();
        $attr      = PackVariables::getScriptAttr();

        $variables = $this->encodeVariables($namespace, $variables);
        $scripts   = $this->formatTemplate('script', [
                        'namespace' => $namespace,
                        'variables' => $variables,
                        'attr'      => $attr
                    ]);

        return $scripts;
    }

    /**
     * encodeVariables
     */
    private function encodeVariables($namespace, $variables)
    {
        $jsVars = '';

        foreach ($variables as $key => $var) {
            $jsVars .= "{$namespace}.{$key} = {$this->json_safe_encode($var)};";
        }

        return $jsVars;
    }

    /**
     * json_safe_encode
     */
    private function json_safe_encode($data)
    {
        return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }
}
