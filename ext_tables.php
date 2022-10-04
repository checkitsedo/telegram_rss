<?php

// Register sprite icons for new tables
/** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
        'tx_telegram_rss-department',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
                'source' => 'EXT:telegram_rss/Resources/Public/Icons/Department.svg'
        ]
);
$iconRegistry->registerIcon(
        'tx_telegram_rss-team',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
                'source' => 'EXT:telegram_rss/Resources/Public/Icons/Team.svg'
        ]
);
