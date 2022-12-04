<?php

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

return [
	'routes' => [
		// PAGES
		['name' => 'page#configuration', 'url' => '/', 'verb' => 'GET'],
		['name' => 'page#configuration', 'url' => '/apps/{appId}', 'verb' => 'GET', 'postfix' => 'apps'],
		['name' => 'page#configuration', 'url' => '/configuration', 'verb' => 'GET', 'postfix' => 'configuration'],

		// SETTINGS API
		['name' => 'settings#index', 'url' => '/api/v1/settings', 'verb' => 'GET'],

		// APPS API
		['name' => 'api#apps', 'url' => '/api/v1/apps', 'verb' => 'GET'],
		['name' => 'api#appInfo', 'url' => '/api/v1/apps/{appId}', 'verb' => 'GET'],

		['name' => 'api#systemInfo', 'url' => '/api/v1/system-info', 'verb' => 'GET'],

		// PACKAGES API
		['name' => 'api#packages', 'url' => '/api/v1/packages', 'verb' => 'GET'],

		// PYTHON API
		['name' => 'python#checkPyFrmInit', 'url' => '/api/v1/python/check_frm_init', 'verb' => 'GET'],
		['name' => 'python#pyFrmInstall', 'url' => '/api/v1/python/py_frm_install/{type}', 'verb' => 'GET'],
	]
];
