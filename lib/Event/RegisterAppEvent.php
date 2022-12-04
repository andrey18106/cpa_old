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

namespace OCA\Cloud_Py_API\Event;

use JsonSerializable;
use OCP\EventDispatcher\Event;


class RegisterAppEvent extends Event implements JsonSerializable
{

	private $params;

	private $appId;

	public function __construct($params = [])
	{
		parent::__construct();
		$this->params = $params;
		if (isset($params['appId'])) {
			$this->appId = $params['appId'];
		}
	}

	public function getAppId(): string
	{
		return $this->appId;
	}

	public function jsonSerialize(): array
	{
		return [
			'params' => $this->params
		];
	}
}
