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

use OCP\EventDispatcher\IEventDispatcher;
use OCP\Migration\IOutput;
use OCP\Migration\IRepairStep;

use OCA\Cloud_Py_API\AppInfo\Application;
use OCA\Cloud_Py_API\Event\RegisterAppEvent;
use OCA\Cloud_Py_API\Event\SyncAppConfigEvent;
use OCA\Cloud_Py_API\Service\AppsService;
use OCA\Cloud_Py_API\Service\PythonService;
use Psr\Log\LoggerInterface;


class AppUpdateStep implements IRepairStep
{

	/** @var IEventDispatcher */
	private $eventDispatcher;

	/** @var AppsService */
	private $appsService;

	/** @var PythonService */
	private $pythonService;

	public function __construct(
		IEventDispatcher $eventDispatcher,
		AppsService $appsService,
		PythonService $pythonService,
		LoggerInterface $logger
	) {
		$this->eventDispatcher = $eventDispatcher;
		$this->appsService = $appsService;
		$this->pythonService = $pythonService;
		$this->logger = $logger;
	}

	public function getName(): string
	{
		return "Cloud_Py_API apps configs synchronization";
	}

	public function run(IOutput $output)
	{
		$output->startProgress(1);
		$this->eventDispatcher->dispatchTyped(new RegisterAppEvent([
			'appId' => 'mediadc',
			'location' => 'remote', // or local (without remote_config)
			'remote_config' => [
				'credentials' => [
					'ssh_host' => 'example.com',
					'ssh_user' => 'unixuser',
					'ssh_pass' => 'securepassword',
					'ssh_identity_file' => '/path/to/identityfile',
					'ssh_identity_pass' => 'securepassword',
				],
				'python_entrypoint' => '/usr/bin/python3',
				'frm_location' => '/path/to/pyfrm',
			],
		])); // Required register event for apps, that using cloud_py_api framework
		/**
		 * --check [framework, app_name]
		 *--install [framework, app_name]
		 *--update [framework, app_name]
		 *--delete [framework, app_name]
		 */
		if ($this->appsService->createFrameworkAppDataFolder()) {
			$this->logger->info('[' . self::class . '] pythonOutput: ' . $this->appsService->getAppDataFolderAbsPath(Application::APP_ID));
			$pythonOutput = $this->pythonService->run('/pyfrm/install.py', [
				$this->appsService->getAppDataFolderAbsPath(Application::APP_ID) => '',
				'--install' => '',
			]);
			$this->logger->info('[' . self::class . '] pythonOutput: ' . json_encode($pythonOutput));
		}
		$output->advance(1);
		$output->finishProgress();
	}
}
