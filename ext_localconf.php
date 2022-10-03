<?php

defined('TYPO3') or die();

(function($extensionKey) {

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:w4_cookiebar/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.tsconfig">'
    );

    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );
    $iconRegistry->registerIcon(
        'w4-cookiebar-banner',
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        ['source' => 'EXT:w4_cookiebar/Resources/Public/Icons/w4_cookiebar_banner..png']
    ); 

})( 'w4_cookiebar');
