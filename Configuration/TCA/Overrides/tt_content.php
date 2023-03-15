<?php

defined('TYPO3') or die();

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function(&$tca, $extensionKey) {

    $ll = 'LLL:EXT:w4_cookiebar/Resources/Private/Language/locallang_db.xlf:w4_cookiebar.';

    $tempColumns = [
        'w4_cookiebar_position' => [
            'exclude' => 1,
            'label' => $ll . 'w4_cookiebar_position',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [ $ll . 'w4_cookiebar_position.top', 'top'],
                    [ $ll . 'w4_cookiebar_position.bottom', 'bottom']
                ],
            ]
        ],
        'w4_cookiebar_text' => [
            'exclude' => 1,
            'label' => $ll . 'text',
            'config' => [
                'type' => 'text',
            ]
        ],
        'w4_cookiebar_button_text' => [
            'exclude' => 1,
            'label' => $ll . 'button_text',
            'config' => [
                'type' => 'input',
            ]
        ],
        'w4_cookiebar_datenschutz_text' => [
            'exclude' => 1,
            'label' => $ll . 'datenschutz_text',
            'config' => [
                'type' => 'input',
            ]
        ],
        'w4_cookiebar_datenschutz_link' => [
            'exclude' => 1,
            'label' => $ll . 'datenschutz_link',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 50,
                'max' => 1024,
                'eval' => 'trim',
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'title' => 'LLL:EXT:seo/Resources/Private/Language/locallang_tca.xlf:pages.canonical_link',
                            'blindLinkFields' => 'class,target,title',
                            'blindLinkOptions' => 'mail,folder,file,telephone'
                        ],
                    ],
                ],
                'softref' => 'typolink'
            ]
        ],
        'w4_cookiebar_edit' => [
            'exclude' => 1,
            'label' => $ll . 'edit',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle'
            ]
         ],
         'w4_cookiebar_wrapper_options' => [
            'label' => $ll . 'wrapper_options',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [$ll . 'wrapper_options.marketing', 'marketing'],
                    [$ll . 'wrapper_options.maps', 'maps'],
                ]
            ],
        ],

    ];

    ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);

    /**
     * Content element "w4_cookiebar_banner"
     */

    $tca['palettes']['w4_cookiebar_banner'] = [
        'showitem' => '
            w4_cookiebar_text,
            , w4_cookiebar_position,
            --linebreak--, 
            w4_cookiebar_button_text,
            --linebreak--, 
            w4_cookiebar_datenschutz_text,
            , w4_cookiebar_datenschutz_link,
            --linebreak--, 
            w4_cookiebar_edit'
    ];

    /**
     * Adds the content element to the "Type" dropdown
     */
    ExtensionManagementUtility::addPlugin(
        [
            $ll .'ctype.banner',
            'w4_cookiebar_banner', // @SEE typoscript tt_content.### for pipe in
            'EXT:w4_cookiebar/Resources/Public/images/Icons/w4_cookiebar_banner.png'
        ],
        'CType',
        $extensionKey
    );

    $tca['types']['w4_cookiebar_banner'] = [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
            --palette--;' . $ll . 'w4_cookiebar.palette.banner;w4_cookiebar_banner,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
            hidden,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended
        ',
        'columns' => [
            ''
        ]
    ];

    /**
     * content element "w4_cookiebar_conditionalGoogleMaps"
     */

    $tca['palettes']['w4_cookiebar_conditionalGoogleMaps'] = [
        'showitem' => '
        w4_cookiebar_wrapper_options;' . $ll .'wrapper_options,
            --linebreak--, 
            bodytext;' . $ll .'google_maps_code,
            --linebreak--,
            image;' . $ll .'google_maps_placeholder_image
        '
    ];

    ExtensionManagementUtility::addPlugin(
        [
            $ll .'ctype.conditional_google_maps',
            'w4_cookiebar_conditionalGoogleMaps', // @SEE typoscript tt_content.### for pipe in
            'EXT:w4_cookiebar/Resources/Public/images/Icons/w4_cookiebar_banner.png'
        ],
        'CType',
        $extensionKey
    );

    $tca['types']['w4_cookiebar_conditionalGoogleMaps'] = [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
            sys_language_uid, l10n_parent, l10n_diffsource,
            --palette--;' . $ll .'palette.conditionalGoogleMaps;w4_cookiebar_conditionalGoogleMaps,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,            
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
            hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended
        ',
        'columns' => [
            ''
        ]
    ];

    // display content of the field "bodytext" as HTML code (syntax highlighting)
    // @SEE web/typo3/sysext/frontend/Configuration/TCA/tt_content.php
    $tca['ctrl']['typeicon_classes']['w4_cookiebar_conditionalGoogleMaps'] = 'mimetypes-x-content-html';
    $tca['ctrl']['typeicon_classes']['w4_cookiebar_banner'] = 'w4-cookiebar-banner';
    
})($GLOBALS['TCA']['tt_content'], 'w4_cookiebar');
