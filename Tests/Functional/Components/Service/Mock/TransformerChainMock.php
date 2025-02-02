<?php
declare(strict_types=1);
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Functional\Components\Service\Mock;

use SwagImportExport\Components\Transformers\DataTransformerChain;

class TransformerChainMock extends DataTransformerChain
{
    public function __construct()
    {
        // DO NOTHING
    }

    /**
     * @return array<string>
     */
    public function composeHeader(): array
    {
        return ['new | empty | header | test'];
    }

    /**
     * @param array<string, array<int, mixed>> $data
     *
     * @return array<string>
     */
    public function transformForward($data): array
    {
        return [\PHP_EOL . 'just | another | return | value'];
    }
}
