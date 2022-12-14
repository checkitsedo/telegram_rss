<?php

// Add new columns to fe_users table
$newColumns = [
    'tx_telegramrss_code' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_employees.code',
        'config' => [
            'type' => 'input',
            'size' => '10',
            'eval' => 'trim',
        ]
    ],
    'tx_telegramrss_department' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_employees.department',
        'config' => [
            'type' => 'group',
            'internal_type' => 'db',
            'allowed' => 'tx_telegramrss_departments',
            'size' => 1,
            'minitems' => 0,
            'maxitems' => 1,
        ]
    ],
    'tx_telegramrss_holidays' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_employees.holidays',
        'config' => [
            'type' => 'input',
            'size' => '10',
            'eval' => 'int',
            'checkbox' => '0',
            'default' => 0
        ]
    ]
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'fe_users',
    $newColumns
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    '--div--;LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_employees,tx_telegramrss_code,tx_telegramrss_department,tx_telegramrss_holidays'
);

// Add the general external information
$GLOBALS['TCA']['fe_users']['external']['general'] = [
    0 => [
        'connector' => 'feed',
        'parameters' => [
            'uri' => 'EXT:telegram_rss/Resources/Private/Data/employees.xml'
        ],
        'data' => 'xml',
        'nodetype' => 'employee',
        'referenceUid' => 'tx_telegramrss_code',
        'priority' => 50,
        'group' => 'telegram_rss',
        'disabledOperations' => '',
        'enforcePid' => true,
        'description' => 'Import of full employee list'
    ],
    1 => [
        'connector' => 'csv',
        'parameters' => [
            'filename' => 'EXT:telegram_rss/Resources/Private/Data/holidays.txt',
            'delimiter' => ',',
            'text_qualifier' => '',
            'skip_rows' => 0,
            'encoding' => 'utf8'
        ],
        'data' => 'array',
        'referenceUid' => 'tx_telegramrss_code',
        'priority' => 60,
        'group' => 'telegram_rss',
        'disabledOperations' => 'insert,delete',
        'description' => 'Import of holidays balance'
    ]
];
// Add the additional fields configuration
$GLOBALS['TCA']['fe_users']['external']['additionalFields'] = [
    0 => [
        'last_name' => [
            'field' => 'last_name'
        ],
        'first_name' => [
            'field' => 'first_name'
        ]
    ]
];

// Add the external information for each column
$GLOBALS['TCA']['fe_users']['columns']['name']['external'] = [
    0 => [
        'field' => 'last_name',
        'transformations' => [
            10 => [
                'userFunction' => [
                    'class' => \Checkitsedo\TelegramRss\Transformation\NameTransformation::class,
                    'method' => 'assembleName'
                ]
            ]
        ]
    ]
];
$GLOBALS['TCA']['fe_users']['columns']['username']['external'] = [
    0 => [
        'field' => 'last_name',
        'transformations' => [
            10 => [
                'userFunction' => [
                    'class' => \Checkitsedo\TelegramRss\Transformation\NameTransformation::class,
                    'method' => 'assembleUserName',
                    'parameters' => [
                        'encoding' => 'utf-8'
                    ]
                ]
            ]
        ]
    ]
];
$GLOBALS['TCA']['fe_users']['columns']['starttime']['external'] = [
    0 => [
        'field' => 'start_date',
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
$GLOBALS['TCA']['fe_users']['columns']['tx_telegramrss_code']['external'] = [
    0 => [
        'field' => 'employee_number'
    ],
    1 => [
        'field' => 0
    ]
];
$GLOBALS['TCA']['fe_users']['columns']['email']['external'] = [
    0 => [
        'field' => 'mail'
    ]
];
$GLOBALS['TCA']['fe_users']['columns']['telephone']['external'] = [
    0 => [
        'field' => 'phone'
    ]
];
$GLOBALS['TCA']['fe_users']['columns']['company']['external'] = [
    0 => [
        'transformations' => [
            10 => [
                'value' => 'The Empire'
            ]
        ]
    ]
];
$GLOBALS['TCA']['fe_users']['columns']['title']['external'] = [
    0 => [
        'field' => 'rank',
        'transformations' => [
            10 => [
                'userFunction' => [
                    'class' => \Checkitsedo\TelegramRss\Transformation\CastTransformation::class,
                    'method' => 'castToInteger'
                ]
            ],
            20 => [
                'mapping' => [
                    'valueMap' => [
                        1 => 'Captain',
                        2 => 'Senior',
                        3 => 'Junior'
                    ]
                ]
            ]
        ],
        'excludedOperations' => 'update'
    ]
];
$GLOBALS['TCA']['fe_users']['columns']['image']['external'] = [
    0 => [
        'field' => 'picture',
        'transformations' => [
            10 => [
                'userFunction' => [
                    'class' => \Cobweb\ExternalImport\Transformation\ImageTransformation::class,
                    'method' => 'saveImageFromBase64',
                    'parameters' => [
                        'storage' => '1:imported_images',
                        'nameField' => 'name',
                        'defaultExtension' => 'jpg'
                    ]
                ]
            ]
        ],
        'children' => [
            'table' => 'sys_file_reference',
            'columns' => [
                'uid_local' => [
                    'field' => 'image'
                ],
                'uid_foreign' => [
                    'field' => '__parent.id__'
                ],
                'title' => [
                    'field' => 'name'
                ],
                'tablenames' => [
                    'value' => 'fe_users'
                ],
                'fieldname' => [
                    'value' => 'image'
                ],
                'table_local' => [
                    'value' => 'sys_file'
                ]
            ],
            'controlColumnsForUpdate' => 'uid_local, uid_foreign, tablenames, fieldname, table_local',
            'controlColumnsForDelete' => 'uid_foreign, tablenames, fieldname, table_local'
        ]
    ]
];
$GLOBALS['TCA']['fe_users']['columns']['tx_telegramrss_department']['external'] = [
    0 => [
        'field' => 'department',
        'transformations' => [
            10 => [
                'mapping' => [
                    'table' => 'tx_telegramrss_departments',
                    'referenceField' => 'code',
                    'whereClause' => 'tx_telegramrss_departments.sys_language_uid = 0'
                ]
            ]
        ]
    ]
];
$GLOBALS['TCA']['fe_users']['columns']['tx_telegramrss_holidays']['external'] = [
    1 => [
        'field' => 1
    ]
];
