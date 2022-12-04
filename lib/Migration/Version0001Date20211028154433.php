<?php

declare(strict_types=1);

/**
 * @copyright Сopyright (c) 2021-2022 Andrey Borysenko <andrey18106x@gmail.com>
 *
 * @copyright Сopyright (c) 2021-2022 Alexander Piskun <bigcat88@icloud.com>
 *
 * @author 2021-2022 Andrey Borysenko <andrey18106x@gmail.com>
 *
 * @license AGPL-3.0-or-later
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Cloud_Py_API\Migration;

use OCP\DB\ISchemaWrapper;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

use OCA\Cloud_Py_API\AppInfo\Application;


class Version0001Date20211028154433 extends SimpleMigrationStep
{

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, \Closure $schemaClosure, array $options)
	{
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		if (!$schema->hasTable(Application::APP_ID . '_settings')) {
			$table = $schema->createTable(Application::APP_ID . '_settings');

			$table->addColumn('id', 'integer', [
				'autoincrement' => true,
				'notnull' => true
			]);
			$table->addColumn('name', 'string', [
				'notnull' => true,
				'default' => ""
			]);
			$table->addColumn('value', 'json', [
				'notnull' => true
			]);
			$table->addColumn('display_name', 'string', [
				'notnull' => true,
				'default' => ""
			]);
			$table->addColumn('title', 'string', [
				'notnull' => true,
				'default' => ""
			]);
			$table->addColumn('description', 'string', [
				'notnull' => true,
				'default' => ""
			]);
			$table->addColumn('help_url', 'string', [
				'notnull' => true,
				'default' => ""
			]);

			$table->setPrimaryKey(['id']);
			$table->addIndex(['name'], 'py_api_setting__index');
		}

		if (!$schema->hasTable(Application::APP_ID . '_apps')) {
			$table = $schema->createTable(Application::APP_ID . '_apps');

			$table->addColumn('id', 'integer', [
				'autoincrement' => true,
				'notnull' => true
			]);
			$table->addColumn('app_id', 'string', [
				'notnull' => true,
				'default' => ""
			]);
			$table->addColumn('token', 'string', [
				'notnull' => true,
				'default' => ""
			]);

			$table->setPrimaryKey(['id']);
			$table->addIndex(['app_id'], 'py_api_app_id__index');
		}

		// if (!$schema->hasTable(Application::APP_ID . '_packages')) {
		// 	$table = $schema->createTable(Application::APP_ID . '_packages');

		// 	$table->addColumn('id', 'bigint', [
		// 		'autoincrement' => true,
		// 		'notnull' => true
		// 	]);
		// 	$table->addColumn('app_id', 'string', [
		// 		'notnull' => true,
		// 		'default' => ''
		// 	]);
		// 	$table->addColumn('name', 'string', [
		// 		'notnull' => true,
		// 		'default' => ''
		// 	]);
		// 	$table->addColumn('source', 'string', [
		// 		'notnull' => true,
		// 		'default' => ''
		// 	]);
		// 	$table->addColumn('location', 'string', [
		// 		'notnull' => true,
		// 		'default' => ''
		// 	]);
		// 	$table->addColumn('version', 'string', [
		// 		'notnull' => true,
		// 		'default' => ''
		// 	]);
		// 	$table->addColumn('installed_time', 'bigint', [
		// 		'notnull' => true,
		// 		'default' => 0
		// 	]);
		// 	$table->addColumn('status', 'string', [
		// 		'notnull' => true,
		// 		'default' => ''
		// 	]);

		// 	$table->setPrimaryKey(['id']);
		// 	$table->addIndex(['app_id'], 'py_api_apps_id__index');
		// 	$table->addIndex(['name'], 'py_api_p_name__index');
		// }

		return $schema;
	}
}
