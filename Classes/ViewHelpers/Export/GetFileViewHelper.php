<?php

namespace TYPO3\VmfdsSermons\ViewHelpers\Export;

class GetFileViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Create a file and write rendered contents to it
     * @param array $container Container data
     * @param string $url Source url
     * @param string $file File name
     * @param string $path Relative path in container (optional)
     */
    public function render($container, $url, $file = NULL, $path = NULL)
    {
        if (strpos($url, '//') === FALSE) {
            $url = $GLOBALS['TSFE']->tmpl->setup['config.']['baseURL'] . $url;
        }
        if (!$file)
            $file = pathinfo($url, PATHINFO_BASENAME);
        $file = $path . $file;
        $content = file_get_contents($url);
        $fp = $this->createFile($container, $file);
        fwrite($fp, $content);
        fclose($fp);
        return '<h2>' . $file . '</h2>Pulled from ' . $url . '<hr />';
    }

    /**
     * Create a file (and folders, if necessary)
     * @param array $container Container data
     * @param string $file File name
     */
    protected function createFile($container, $file)
    {
        $folder = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($container['fullPath'] . $folder))
            mkdir($container['fullPath'] . $folder, 0777, true);
        $fp = fopen($container['fullPath'] . $file, 'w');
        return $fp;
    }

}
