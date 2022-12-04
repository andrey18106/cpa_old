<?php

declare(strict_types=1);

/**
 * @copyright Copyright (c) 2021 Andrey Borysenko <andrey18106x@gmail.com>
 * 
 * @copyright Copyright (c) 2021 Alexander Piskun <bigcat88@icloud.com>
 * 
 * @author 2021 Andrey Borysenko <andrey18106x@gmail.com>
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

namespace OCA\Cloud_Py_API\Framework\JSON;

use OCA\Cloud_Py_API\Service\UtilsService;


use OCA\Cloud_Py_API\Proto\TaskExitRequest;
use OCA\Cloud_Py_API\Proto\TaskLogRequest;
use OCA\Cloud_Py_API\Proto\CheckDataRequest;
use OCA\Cloud_Py_API\Proto\CheckDataRequest\installed_pckg;
use OCA\Cloud_Py_API\Proto\CheckDataRequest\missing_pckg;
use OCA\Cloud_Py_API\Proto\OccRequest;
use OCA\Cloud_Py_API\Service\PythonService;
use Psr\Log\LoggerInterface;

/**
 * Cloud_Py_API Framework JSON Core API (not using gRPC)
 */
class Core {

	/** @var PythonService */
	private $pythonService;

	public function __construct(PythonService $pythonService,
								UtilsService $utils, LoggerInterface $logger) {
		$this->pythonService = $pythonService;
		$this->utils = $utils;
		$this->logger = $logger;
	}

	public function runPyfrm(): array {
		// TODO Run Pyfrm to handle task
		return $this->pythonService->run('/pyfrm/main.py');
	}

	/**
	 * Send TaskLog request
	 * 
	 * @param \OCA\Cloud_Py_API\Proto\CloudPyApiCoreClient $client
	 * @param array $params
	 * 
	 * @return array [
	 * 	'response' => OCA\Cloud_Py_API\Proto\PBEmpty,
	 * 	'status' => ['metadata', 'code', 'details']
	 * ]
	 */
	public function TaskLog($client, $params = []): array {
		$request = new TaskLogRequest();
		if (isset($params['logLvl'])) {
			$request->setLogLvl($params['logLvl']);
		}
		if (isset($params['module'])) {
			$request->setModule($params['module']);
		}
		if (isset($params['content'])) {
			$request->setContent($params['content']);
		}
		return $client->TaskLog($request)->wait();
	}

	/**
	 * Send TaskExit request with passing $result to initiator callback
	 * and closing server process
	 * 
	 * @param \OCA\Cloud_Py_API\Proto\CloudPyApiCoreClient $client
	 * @param array $params
	 * 
	 * @return array [
	 * 	'response' => OCA\Cloud_Py_API\Proto\PBEmpty,
	 * 	'status' => ['metadata', 'code', 'details']
	 * ]
	 */
	public function TaskExit($client, $params = []): array {
		$request = new TaskExitRequest();
		if (isset($params['result'])) {
			$request->setResult($params['result']);
		}
		return $client->TaskExit($request)->wait();
	}

	/**
	 * Send AppCheck request for checking python requirements installation
	 * 
	 * @param array $params not_installed and installed packages lists
	 * 
	 * @return array
	 */
	public function AppCheck($params = []): array {
		// TODO
		$request = new CheckDataRequest();
		if (isset($params['not_installed'])) {
			$not_installed = array_map(function(array $pckg) {
				$missing_pckg = new missing_pckg();
				if (isset($pckg['name'])) {
					$missing_pckg->setName($pckg['name']);
				}
				if (isset($pckg['version'])) {
					$missing_pckg->setVersion($pckg['version']);
				}
				return $missing_pckg;
			}, $params['not_installed']);
			$request->setNotInstalled($not_installed);
		}
		if (isset($params['installed'])) {
			$installed = array_map(function(array $pckg) {
				$installed_pckg = new installed_pckg();
				if (isset($pckg['name'])) {
					$installed_pckg->setName($pckg['name']);
				}
				if (isset($pckg['version'])) {
					$installed_pckg->setVersion($pckg['version']);
				}
				if (isset($pckg['location'])) {
					$installed_pckg->setLocation($pckg['location']);
				}
				if (isset($pckg['summary'])) {
					$installed_pckg->setSummary($pckg['summary']);
				}
				if (isset($pckg['requires'])) {
					$installed_pckg->setRequires($pckg['requires']);
				}
				return $installed_pckg;
			}, $params['installed']);
			$request->setInstalled($installed);
		}
		return [];
	}

	/**
	 * Send OccCall request for executing Nextcloud OCC CLI command
	 * 
	 * @param array $params arguments array
	 * 
	 * @return array
	 */
	public function OccCall($params = []): array {
		// TODO
		$request = new OccRequest();
		if (isset($params['arguments'])) {
			$request->setArguments($params['arguments']);
		}
		return [];
	}

}
