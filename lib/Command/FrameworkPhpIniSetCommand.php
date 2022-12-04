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

namespace OCA\Cloud_Py_API\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class FrameworkPhpIniSetCommand extends Command
{
	public const ARGUMENT_GRPC_PATH = 'path_to_grpc_so';

	public function __construct()
	{
		parent::__construct();
	}

	protected function configure(): void
	{
		$this->setName("cloud_py_api:framework:ini:grpc:set");
		$this->setDescription("Set cloud_py_api python framework php.ini grpc setting");
		$this->addArgument(self::ARGUMENT_GRPC_PATH, InputArgument::OPTIONAL);
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		// $pathToGrpcSo = $input->getArgument(self::ARGUMENT_GRPC_PATH);
		$output->writeln('result_code: ' . json_encode(exec('phpenmod grpc', $output, $result_code)));
		return 0;
	}
}
