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
