<?php
declare(strict_types=1);
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Functional\Components\Service\Mock;

use SwagImportExport\Components\FileIO\FileWriter;

class FileIoMock implements FileWriter
{
    public function __construct()
    {
        // DO NOTHING
    }

    /**
     * @param mixed|null $headerData
     */
    public function writeHeader(string $fileName, $headerData): void
    {
        \file_put_contents($fileName, $headerData);
    }

    /**
     * @param mixed|null $treeData
     */
    public function writeRecords(string $fileName, $treeData): void
    {
        \file_put_contents($fileName, $treeData, \FILE_APPEND);
    }

    public function supports(string $format): bool
    {
        return true;
    }

    public function writeFooter(string $fileName, ?array $footerData): void
    {
        // nth
    }

    public function hasTreeStructure(): bool
    {
        return false;
    }
}
