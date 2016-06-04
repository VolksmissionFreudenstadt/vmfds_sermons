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
