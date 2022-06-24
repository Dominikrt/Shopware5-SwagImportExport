<?php
declare(strict_types=1);
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Tests\Integration\Components;

use SwagImportExport\Components\DataIO;
use SwagImportExport\Components\Factories\ProfileFactory;
use SwagImportExport\Components\Logger\Logger;
use SwagImportExport\Components\Providers\DataProvider;
use SwagImportExport\Components\Session\SessionService;
use SwagImportExport\Components\Structs\ExportRequest;
use SwagImportExport\Tests\Helper\ContainerTrait;
use SwagImportExport\Tests\Helper\ImportExportTestHelper;

class DataIOTest extends ImportExportTestHelper
{
    use ContainerTrait;

    public function testPreloadRecordIds(): void
    {
        $dataProvider = $this->getContainer()->get(DataProvider::class);
        $sessionService = $this->getContainer()->get(SessionService::class);
        $session = $sessionService->createSession();
        $dbAdapter = $dataProvider->createDbAdapter('categories');
        $logger = $this->getContainer()->get(Logger::class);
        $profileFactory = $this->getContainer()->get(ProfileFactory::class);
        $profile = $profileFactory->loadProfile(1);

        $dataIO = new DataIO($dbAdapter, $session, $logger);

        $exportRequest = new ExportRequest();
        $exportRequest->setData(
            [
                'profileEntity' => $profile,
                'filter' => [],
                'format' => 'csv',
            ]
        );
        $dataIO->preloadRecordIds($exportRequest, $session);

        $allIds = $session->getRecordIds();

        static::assertCount(62, $allIds);
    }
}
