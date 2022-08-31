<?php
declare(strict_types=1);
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagImportExport\Setup\Update;

use Doctrine\DBAL\Connection;
use SwagImportExport\Setup\DefaultProfiles\ProfileHelper;

class DefaultProfileUpdater
{
    private Connection $connection;

    public function __construct(
        Connection $connection
    ) {
        $this->connection = $connection;
    }

    /**
     * Updates the default profiles.
     * We won´t update unique profile names and types.
     * Only changes to the profile tree should
     * be made and make sense.
     */
    public function update(): void
    {
        $sql = '
            UPDATE s_import_export_profile
            SET `tree` = :tree, `description` = :description
            WHERE `name` = :name AND is_default = 1
        ';

        $profiles = ProfileHelper::getProfileInstances();

        foreach ($profiles as $profile) {
            $serializedTree = \json_encode($profile);

            $params = [
                'tree' => $serializedTree,
                'name' => $profile->getName(),
                'description' => $profile->getDescription(),
            ];

            $this->connection->executeQuery($sql, $params);
        }
    }
}
