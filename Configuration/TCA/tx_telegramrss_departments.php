<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_departments',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY name',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'languageField' => 'sys_language_uid',
        'searchFields' => 'code, name',
        'typeicon_classes' => [
            'default' => 'tx_telegram_rss-department'
        ]
    ],
    'external' => [
        'general' => [
            'english' => [
                'connector' => 'csv',
                'parameters' => [
                    'filename' => 'EXT:telegram_rss/Resources/Private/Data/departments.txt',
                    'delimiter' => "\t",
                    'text_qualifier' => '"',
                    'skip_rows' => 1,
                    'encoding' => 'latin1'
                ],
                'data' => 'array',
                'referenceUid' => 'code',
                'whereClause' => 'tx_telegramrss_departments.sys_language_uid = 0',
                'priority' => 10,
                'group' => 'telegram_rss',
                'description' => 'Import of all company departments (English, default language)'
            ],
            'french' => [
                'connector' => 'csv',
                'parameters' => [
                    'filename' => 'EXT:telegram_rss/Resources/Private/Data/departments.txt',
                    'delimiter' => "\t",
                    'text_qualifier' => '"',
                    'skip_rows' => 1,
                    'encoding' => 'latin1'
                ],
                'data' => 'array',
                'referenceUid' => 'code',
                'whereClause' => 'tx_telegramrss_departments.sys_language_uid = 1',
                'priority' => 15,
                'group' => 'telegram_rss',
                'description' => 'Import of all company departments (French translation)'
            ]
        ]
    ],
    'columns' => [
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => '0'
            ]
        ],
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1
                    ],
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value',
                        0
                    ]
                ],
                'allowNonIdValues' => true,
            ],
            'external' => [
                'french' => [
                    'field' => 'code',
                    'transformations' => [
                        10 => [
                            'value' => 1
                        ]
                    ]
                ]
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '',
                        0
                    ]
                ],
                'foreign_table' => 'tx_telegramrss_departments',
                'foreign_table_where' => 'AND tx_telegramrss_departments.pid=###CURRENT_PID### AND tx_telegramrss_departments.sys_language_uid IN (-1,0)',
                'default' => 0
            ],
            'external' => [
                'french' => [
                    'field' => 'code',
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
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'code' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_departments.code',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'max' => 4,
                'eval' => 'required,trim',
            ],
            'external' => [
                'english' => [
                    'field' => 'code'
                ],
                'french' => [
                    'field' => 'code'
                ]
            ]
        ],
        'name' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_departments.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required,trim',
            ],
            'external' => [
                'english' => [
                    'field' => 'name_en'
                ],
                'french' => [
                    'field' => 'name_fr'
                ]
            ]
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                hidden, code, name,
                --div--;LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language, sys_language_uid, l10n_parent
            '
        ]
    ]
];
