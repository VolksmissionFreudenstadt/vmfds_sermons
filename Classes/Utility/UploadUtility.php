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

namespace TYPO3\VmfdsSermons\Utility;

/**
 *
 * Misc Functions
 *
 * @package wsevents
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class UploadUtility
{

    /**
     * objectManager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * Upload file
     *
     * @param \string $imageField Image field
     * @param \string $table Table name
     * @param \string $field Field name
     * @return mixed	false or file.png
     */
    public function uploadFile($imageField, $table, $field)
    {
        // Check file extension
        if (empty($imageField['name']) || !self::checkExtension($imageField['name'], $table, $field)) {
            return FALSE;
        }
        // create new filename and upload it
        $basicFileFunctions = $this->objectManager->get('TYPO3\CMS\Core\Utility\File\BasicFileUtility');
        $newFile = $basicFileFunctions->getUniqueName(
                $imageField['name'], \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(self::getUploadFolderFromTca($table, $field))
        );
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::upload_copy_move($imageField['tmp_name'], $newFile)) {
            $fileInfo = pathinfo($newFile);
            return $fileInfo['basename'];
        }
        return FALSE;
    }

    /**
     * Check extension of given filename
     *
     * @param \string		Filename like (upload.png)
     * @param \string $table Table name
     * @param \string $field Field name
     * @return \bool		If Extension is allowed
     */
    public static function checkExtension($filename, $table, $field)
    {
        $extensionList = $GLOBALS['TCA'][$table]['columns'][$field]['config']['allowed'];
        $fileInfo = pathinfo($filename);
        if (!empty($fileInfo['extension']) && \TYPO3\CMS\Core\Utility\GeneralUtility::inList($extensionList, strtolower($fileInfo['extension']))) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Read image uploadfolder from TCA
     * @param \string $table Table name
     * @param \string $field Field name
     * @return \string path - standard "uploads/pics"
     */
    public static function getUploadFolderFromTca($table, $field)
    {
        $path = $GLOBALS['TCA'][$table]['columns'][$field]['config']['uploadfolder'];
        if (empty($path)) {
            $path = 'uploads/pics';
        }
        return $path;
    }

}
