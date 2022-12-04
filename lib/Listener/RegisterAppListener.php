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

namespace OCA\Cloud_Py_API\Listener;

use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use OCA\Cloud_Py_API\Event\RegisterAppEvent;
use OCA\Cloud_Py_API\Service\AppsService;


class RegisterAppListener implements IEventListener
{

	/** @var AppsService */
	private $appsService;

	public function __construct(AppsService $appsService)
	{
		$this->appsService = $appsService;
	}

	public function handle(Event $event): void
	{
		if (!$event instanceof RegisterAppEvent) {
			return;
		}
		$this->appsService->registerApp($event->getAppId());
	}
}
