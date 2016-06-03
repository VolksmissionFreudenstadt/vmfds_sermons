<?php

namespace TYPO3\VmfdsSermons\ViewHelpers\Export;

class CopyFileViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Create a file and write rendered contents to it
     * @param array $container Container data
     * @param string $source Source file
     * @param string $target Target file name
     * @param string $path Relative path in container (optional)
     */
    public function render($container, $source, $target = NULL, $path = NULL)
    {
        if (!$target)
            $target = pathinfo($source, PATHINFO_BASENAME);
        if (pathinfo($target, PATHINFO_EXTENSION) == '')
            $target .= '.' . pathinfo($source, PATHINFO_EXTENSION);
        $x = $this->createFilePath($container, $path . $target);
        copy(PATH_site . $source, $container['fullPath'] . $path . $target);
        return '<h2>' . $path . $target . '</h2>Copied from ' . PATH_site . $source . '<hr />';
    }

    /**
     * Create a file path with folders, if necessary
     * @param array $container Container data
     * @param string $file File name
     */
    protected function createFilePath($container, $file)
    {
        $folder = pathinfo($file, PATHINFO_DIRNAME);
        if ($folder == '.')
            $folder = '';
        if (!is_dir($container['fullPath'] . $folder))
            mkdir($container['fullPath'] . $folder, 0777, true);
        return $container['fullPath'] . $folder;
    }

}
