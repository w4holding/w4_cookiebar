<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

(function($extensionKey) {

    /**
     * add new entry to template properties
     * static includes
     */

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extensionKey, 'Configuration/TypoScript/BaseCookiebar', 'W4 Cookiebar');

})('w4_cookiebar');
