<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'W4 Cookiebar',
    'description' => 'W4 extension to provide a GDPR (DE: "DSGVO") cookie banner.',
    'version' => '1.0.8',
    'category' => 'fe',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-12.4.99'
        ],
    ],
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'author' => 'W4 Services GmbH',
    'author_email' => 'info@w-4.ch',
    'author_company' => 'W4 Services GmbH',
    'autoload' => [
        'psr-4' => [
            'W4Services\\W4Cookiebar\\' => 'Classes'
        ],
    ],
];
