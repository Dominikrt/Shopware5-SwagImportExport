<?php
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Components\Utils;

class SwagVersionHelper
{
    /**
     * @param string $version
     */
    public static function hasMinimumVersion($version): bool
    {
        $actualVersion = Shopware()->Config()->version;

        if ($actualVersion === '___VERSION___') {
            return true;
        }

        return \version_compare($actualVersion, $version, '>=');
    }

    public static function isShopware578(): bool
    {
        return class_exists('Shopware\Bundle\CustomerSearchBundle\Condition\HasNoAddressWithCountryCondition');
    }
}
