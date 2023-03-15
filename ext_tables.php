<?php

defined('TYPO3') or die();

(function($extensionKey) {

    /**
     * add new entry to template properties
     * static includes
     */

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extensionKey, 'Configuration/TypoScript', 'W4 Cookiebar');

})('w4_cookiebar');
