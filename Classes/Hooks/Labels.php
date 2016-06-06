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

namespace TYPO3\VmfdsSermons\Hooks;

use TYPO3\CMS\Backend\Utility\BackendUtility as BackendUtilityCore;
use TYPO3\CMS\Core\Resource\Exception\FolderDoesNotExistException;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Labels
{

    /**
     * Get a slide label
     * @param array $params
     * @return void
     */
    public function getSlideLabel(array &$params)
    {
        if (!empty($params['row']['image'])) {
            $params['row']['image'] = $this->splitFileName($params['row']['image']);
            try {
                $params['title'] = BackendUtilityCore::thumbCode($params['row'], 'tx_vmfdssermons_domain_model_slide', 'image', $GLOBALS['BACK_PATH'], '', null, 0, '', '', false)
                        . '&nbsp;' . htmlspecialchars($params['row']['title']);
            } catch (FolderDoesNotExistException $exception) {
                $params['title'] = htmlspecialchars($params['row']['title']);
            }
        } else {
            $params['title'] = htmlspecialchars($params['row']['title']);
        }
    }

    /**
     * Split the filename
     * @param string $title
     * @return string
     */
    protected function splitFileName($title)
    {
        $split = explode('|', $title);
        if (count($split) === 2 && $split[0] === $split[1]) {
            $title = $split[0];
        }

        return $title;
    }

}
