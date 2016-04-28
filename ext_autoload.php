<?php

$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('vmfds_sermons') . 'Classes/';

$default = [
    'TYPO3\\VmfdsSermons\\Utility\\UploadUtility' => $extensionClassesPath . 'Utility/UploadUtility.php',
];
return $default;
