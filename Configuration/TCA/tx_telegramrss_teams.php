<?php

return [
        'ctrl' => [
                'title' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_teams',
                'label' => 'name',
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                'cruser_id' => 'cruser_id',
                'default_sortby' => 'ORDER BY name',
                'delete' => 'deleted',
                'enablecolumns' => [
                        'disabled' => 'hidden',
                ],
                'searchFields' => 'code,name',
                'typeicon_classes' => [
                        'default' => 'tx_telegram_rss-team'
                ]
        ],
        'external' => [
                'general' => [
                        0 => [
                                'connector' => 'csv',
                                'parameters' => [
                                        'filename' => 'EXT:telegram_rss/Resources/Private/Data/teams.txt',
                                        'delimiter' => "\t",
                                        'text_qualifier' => '',
                                        'skip_rows' => 1,
                                        'encoding' => 'utf8'
                                ],
                                'data' => 'array',
                                'referenceUid' => 'code',
                                'priority' => 100,
                                'group' => 'telegram_rss',
                                'description' => 'Import of all employee teams'
                        ]
                ],
                'additionalFields' => [
                        0 => [
                                'rank' => [
                                        'field' => 'rank'
                                ]
                        ]
                ]
        ],
        'interface' => [
                'showRecordFieldList' => 'hidden,code,name'
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
                'code' => [
                        'exclude' => 0,
                        'label' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_teams.code',
                        'config' => [
                                'type' => 'input',
                                'size' => 10,
                                'max' => 5,
                                'eval' => 'required,trim',
                        ],
                        'external' => [
                                0 => [
                                        'field' => 'code'
                                ]
                        ]
                ],
                'name' => [
                        'exclude' => 0,
                        'label' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_teams.name',
                        'config' => [
                                'type' => 'input',
                                'size' => 30,
                                'eval' => 'required,trim',
                        ],
                        'external' => [
                                0 => [
                                        'field' => 'name'
                                ]
                        ]
                ],
                'members' => [
                        'exclude' => 0,
                        'label' => 'LLL:EXT:telegram_rss/Resources/Private/Language/locallang_db.xlf:tx_telegramrss_teams.members',
                        'config' => [
                                'type' => 'group',
                                'size' => 5,
                                'internal_type' => 'db',
                                'allowed' => 'fe_users',
                                'MM' => 'tx_telegramrss_teams_feusers_mm',
                                'maxitems' => 100
                        ],
                        'external' => [
                                0 => [
                                        'field' => 'employee',
                                        'multipleRows' => true,
                                        'multipleSorting' => 'rank',
                                        'transformations' => [
                                                10 => [
                                                        'mapping' => [
                                                                'table' => 'fe_users',
                                                                'referenceField' => 'tx_telegramrss_code',
                                                        ],
                                                ]
                                        ]
                                ]
                        ]
                ],
        ],
        'types' => [
                '0' => ['showitem' => 'hidden, code, name, members']
        ]
];
