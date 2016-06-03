<?php

namespace TYPO3\VmfdsSermons\ViewHelpers\Export;

class CreateFileViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Create a file and write rendered contents to it
     * @param array $container Container data
     * @param string $file File name
     */
    public function render($container, $file)
    {
        $content = $this->renderChildren();
        $fp = $this->createFile($container, $file);
        fwrite($fp, $content);
        fclose($fp);
        return '<h2>' . $file . '</h2><pre>' . $content . '</pre><hr />';
    }

    /**
     * Create a file (and folders, if necessary)
     * @param array $container Container data
     * @param string $file File name
     */
    protected function createFile($container, $file)
    {
        $folder = '/' . pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($container['fullPath'] . $folder))
            mkdir($container['fullPath'] . $folder, 0777, true);
        $fp = fopen($container['fullPath'] . '/' . $file, 'w');
        return $fp;
    }

}
