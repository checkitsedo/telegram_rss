<?php

// Add a new column for containing the external id
$tempColumns = [
    'tx_telegramrss_externalid' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_txnews.externalid',
        'config' => [
            'type' => 'input',
            'size' => '20'
        ]
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_news_domain_model_news',
    $tempColumns
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news',
    'tx_telegramrss_externalid'
);

// Add the external general information
$GLOBALS['TCA']['tx_news_domain_model_news']['external']['general'] = [
    0 => [
        'connector' => 'feed',
        'parameters' => [
            'uri' => 'https://rsshub.app/telegram/channel/pfarrei_stjosef_zuerich'
        ],
        'data' => 'xml',
        'nodetype' => 'item',
        'referenceUid' => 'tx_telegramrss_externalid',
        'enforcePid' => true,
        'priority' => 200,
        'group' => 'telegram_rss',
        'disabledOperations' => 'delete',
        'description' => 'Import of typo3.org news'
    ],
];
// Add the external information for each column
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['title']['external'] = [
    0 => [
        'field' => 'title'
    ]
];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['tx_telegramrss_externalid']['external'] = [
    0 => [
        'field' => 'link',
        'transformations' => [
            10 => [
                'trim' => true
            ]
        ]
    ]
];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['datetime']['external'] = [
    0 => [
        'field' => 'pubDate',
        'transformations' => [
            10 => [
                'userFunction' => [
                    'class' => \Cobweb\ExternalImport\Transformation\DateTimeTransformation::class,
                    'method' => 'parseDate'
                ]
            ]
        ]
    ]
];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['teaser']['external'] = [
    0 => [
        'field' => 'description',
        'transformations' => [
            10 => [
                'userFunction' => [
                    'class' => \Checkitsedo\TelegramRss\Transformation\LinkTransformation::class,
                    'method' => 'absolutizeUrls',
                    'parameters' => [
                        'host' => 'https://rsshub.app'
                    ]
                ]
            ],
            20 => [
                'rteEnabled' => true
            ]
        ]
    ]
];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['bodytext']['external'] = [
    0 => [
        'field' => 'description',
        'transformations' => [
            10 => [
                'userFunction' => [
                    'class' => \Checkitsedo\TelegramRss\Transformation\LinkTransformation::class,
                    'method' => 'absolutizeUrls',
                    'parameters' => [
                        'host' => 'https://rsshub.app'
                    ]
                ]
            ],
            20 => [
                'rteEnabled' => true
            ]
        ]
    ]
];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['type']['external'] = [
    0 => [
        'transformations' => [
            10 => [
                'value' => 0
            ]
        ]
    ]
];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['hidden']['external'] = [
    0 => [
        'transformations' => [
            10 => [
                'value' => 0
            ]
        ]
    ]
];
