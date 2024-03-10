<?php

declare(strict_types=1);

use Rector\Symfony\Set\SymfonySetList;
use Rector\Symfony\Set\SymfonyLevelSetList;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/bin',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // register a single rule
    // $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);
    // $rectorConfig->rule(TypedPropertyRector::class);

    $rectorConfig->symfonyContainerXml(__DIR__ . '/var/cache/dev/App_KernelDevDebugContainer.xml');

   $rectorConfig->sets([
        // SymfonySetList::SYMFONY_25,
        // SymfonySetList::SYMFONY_26,
        // SymfonySetList::SYMFONY_27,
        // SymfonySetList::SYMFONY_28,
        // SymfonySetList::SYMFONY_30,
        // SymfonySetList::SYMFONY_31,
        // SymfonySetList::SYMFONY_32,
        // SymfonySetList::SYMFONY_33,
        // SymfonySetList::SYMFONY_34,
        // SymfonySetList::SYMFONY_40,
        // SymfonySetList::SYMFONY_41,
        // SymfonySetList::SYMFONY_42,
        // SymfonySetList::SYMFONY_43,
        // SymfonySetList::SYMFONY_44,
        // SymfonySetList::SYMFONY_50,
        // SymfonySetList::SYMFONY_50_TYPES,
        // SymfonySetList::SYMFONY_51,
        // SymfonySetList::SYMFONY_52,
        // SymfonySetList::SYMFONY_53,
        // SymfonySetList::SYMFONY_54,
        // SymfonySetList::SYMFONY_52_VALIDATOR_ATTRIBUTES,
        SymfonySetList::SYMFONY_60,
        // SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
        SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES,
        // SymfonySetList::SYMFONY_STRICT,
        // #######
        // SymfonyLevelSetList::UP_TO_SYMFONY_25,
        // SymfonyLevelSetList::UP_TO_SYMFONY_26,
        // SymfonyLevelSetList::UP_TO_SYMFONY_27,
        // SymfonyLevelSetList::UP_TO_SYMFONY_28,
        // SymfonyLevelSetList::UP_TO_SYMFONY_30,
        // SymfonyLevelSetList::UP_TO_SYMFONY_31,
        // SymfonyLevelSetList::UP_TO_SYMFONY_32,
        // SymfonyLevelSetList::UP_TO_SYMFONY_33,
        // SymfonyLevelSetList::UP_TO_SYMFONY_34,
        // SymfonyLevelSetList::UP_TO_SYMFONY_40,
        // SymfonyLevelSetList::UP_TO_SYMFONY_41,
        // SymfonyLevelSetList::UP_TO_SYMFONY_42,
        // SymfonyLevelSetList::UP_TO_SYMFONY_43,
        // SymfonyLevelSetList::UP_TO_SYMFONY_44,
        // SymfonyLevelSetList::UP_TO_SYMFONY_50,
        // SymfonyLevelSetList::UP_TO_SYMFONY_51,
        // SymfonyLevelSetList::UP_TO_SYMFONY_52,
        // SymfonyLevelSetList::UP_TO_SYMFONY_53,
        // SymfonyLevelSetList::UP_TO_SYMFONY_54,
        SymfonyLevelSetList::UP_TO_SYMFONY_60,

        // LevelSetList::UP_TO_PHP_82,
        // LevelSetList::UP_TO_PHP_81,
        // LevelSetList::UP_TO_PHP_80,
        // LevelSetList::UP_TO_PHP_74,
        // LevelSetList::UP_TO_PHP_73,
        // LevelSetList::UP_TO_PHP_72,
        // LevelSetList::UP_TO_PHP_71,
        // LevelSetList::UP_TO_PHP_70,
        // LevelSetList::UP_TO_PHP_56,
        // LevelSetList::UP_TO_PHP_55,
        // LevelSetList::UP_TO_PHP_54,
        // /SetList::ACTION_INJECTION_TO_CONSTRUCTOR_INJECTION,
        //  SetList::CODE_QUALITY,
        //  SetList::CODING_STYLE,
        //  SetList::DEAD_CODE,
        //  SetList::GMAGICK_TO_IMAGICK,
        //  SetList::MONOLOG_20,
        //  SetList::MYSQL_TO_MYSQLI,
        //  SetList::NAMING,
        //  SetList::PHP_52,
        //  SetList::PHP_53,
        //  SetList::PHP_54,
        //  SetList::PHP_55,
        //  SetList::PHP_56,
        //  SetList::PHP_70,
        //  SetList::PHP_71,
        //  SetList::PHP_72,
        //  SetList::PHP_73,
        //  SetList::PHP_74,
        //  SetList::PHP_80,
         // SetList::PHP_81,
        //  SetList::PHP_82,
        //  SetList::PRIVATIZATION,
        //  SetList::PSR_4,
        //  SetList::TYPE_DECLARATION,
        //  SetList::TYPE_DECLARATION_STRICT,
        //  SetList::EARLY_RETURN,
        // PHPUnitSetList::PHPUNIT80_DMS,
        // PHPUnitSetList::PHPUNIT_40,
        // PHPUnitSetList::PHPUNIT_50,
        // PHPUnitSetList::PHPUNIT_60,
        // PHPUnitSetList::PHPUNIT_70,
        // PHPUnitSetList::PHPUNIT_80,
        // PHPUnitSetList::PHPUNIT_90,
        // PHPUnitSetList::PHPUNIT_91,
        // PHPUnitSetList::PHPUNIT_CODE_QUALITY,
        // PHPUnitSetList::PHPUNIT_EXCEPTION,
        // PHPUnitSetList::REMOVE_MOCKS,
        // PHPUnitSetList::PHPUNIT_SPECIFIC_METHOD,
        // PHPUnitSetList::PHPUNIT_YIELD_DATA_PROVIDER,
   ]);
};
