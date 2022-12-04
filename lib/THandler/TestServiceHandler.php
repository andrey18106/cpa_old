<?php

declare(strict_types=1);

/**
 * @copyright Сopyright (c) 2022 Andrey Borysenko <andrey18106x@gmail.com>
 *
 * @copyright Сopyright (c) 2022 Alexander Piskun <bigcat88@icloud.com>
 *
 * @author 2022 Andrey Borysenko <andrey18106x@gmail.com>
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

namespace OCA\Cloud_Py_API\THandler;

use OCA\Cloud_Py_API\TProto\TestServiceIf;
use Thrift\ClassLoader\ThriftClassLoader;

class TestServiceHandler implements TestServiceIf
{
	public function __construct()
	{
		// $loader = new ThriftClassLoader();
		// $loader->registerNamespace('test', '../../TProto');
		// $loader->register();
	}

	/**
	 * @param int $logLvl
	 * @return int
	 */
	public function ping($logLvl): int
	{
		return $logLvl;
	}

	/**
	 * @param int $resultCode
	 * @return void
	 */
	public function exit($resultCode): void
	{
		print('Closing with ' . $resultCode . ' result code.');
		exit($resultCode);
	}
}