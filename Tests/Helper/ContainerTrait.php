<?php

declare(strict_types=1);
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Helper;

use Shopware\Components\DependencyInjection\Container;

trait ContainerTrait
{
    public function getContainer(): Container
    {
        return Shopware()->Container();
    }
}
