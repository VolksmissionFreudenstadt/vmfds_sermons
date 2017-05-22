<?php

/*
 * @package vmfds_sermons
 * @copyright Copyright (c) 2012-2016 Volksmission Freudenstadt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License v3 or later
 * @site http://open.vmfds.de
 * @author Christoph Fischer <chris@toph.de>
 * @date 2016-06-04
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

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
