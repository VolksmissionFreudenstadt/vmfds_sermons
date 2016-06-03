<?php

namespace TYPO3\VmfdsSermons\ViewHelpers\Export;

class ContainerViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Create a container folder
     * @param string $path Path to container folder
     * @param string $as Variable name
     */
    public function render($path, $as)
    {
        $container = [];
        $container['relPath'] = $path . '/';
        $container['fullPath'] = PATH_site . $path . '/';
        if (!is_dir($path))
            mkdir($container['fullPath'], 0777, true);

        if (TRUE === $this->templateVariableContainer->exists($as)) {
            $this->templateVariableContainer->remove($as);
        }
        $this->templateVariableContainer->add($as, $container);

        return $this->renderChildren();
    }

}
