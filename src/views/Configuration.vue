<!--
 - @copyright Copyright (c) 2021-2022 Andrey Borysenko <andrey18106x@gmail.com>
 -
 - @copyright Copyright (c) 2021-2022 Alexander Piskun <bigcat88@icloud.com>
 -
 - @author 2021-2022 Andrey Borysenko <andrey18106x@gmail.com>
 -
 - @license AGPL-3.0-or-later
 -
 - This program is free software: you can redistribute it and/or modify
 - it under the terms of the GNU Affero General Public License as
 - published by the Free Software Foundation, either version 3 of the
 - License, or (at your option) any later version.
 -
 - This program is distributed in the hope that it will be useful,
 - but WITHOUT ANY WARRANTY; without even the implied warranty of
 - MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 - GNU Affero General Public License for more details.
 -
 - You should have received a copy of the GNU Affero General Public License
 - along with this program. If not, see <http://www.gnu.org/licenses/>.
 -
 -->

<template>
	<div class="cloud_py_api-configuration">
		<h2>{{ t('cloud_py_api', 'Cloud Py API Configuration') }}</h2>
		<p>{{ t('cloud_py_api', 'Here will be list of registered apps, that using Python (via this Framework)') }}</p>
		<div v-if="apps && apps.length > 0" class="apps-list">
			<a v-for="app of apps"
				:key="app.id"
				class="registered-app"
				:href="getAppConfigurationUrl(app)">
				{{ app.id }}. {{ app.app_id }} (token: {{ app.token }})
			</a>
		</div>
		<div v-else>
			<b>{{ t('cloud_py_api', 'No apps registered') }}</b>
		</div>
	</div>
</template>

<script>
import axios from '@nextcloud/axios'
import { generateUrl } from '@nextcloud/router'

export default {
	name: 'Configuration',
	data() {
		return {
			apps: [],
		}
	},
	beforeMount() {
		this.getApps()
	},
	mounted() {
		this.$emit('update:loading', false)
	},
	methods: {
		getApps() {
			this.$emit('update:loading', true)
			axios.get(generateUrl('/apps/cloud_py_api/api/v1/apps')).then(res => {
				this.apps = res.data
				this.$emit('update:loading', false)
			}).catch(err => {
				console.debug(err)
				this.$emit('update:loading', false)
			})
		},
		getAppConfigurationUrl(app) {
			return generateUrl(`/apps/cloud_py_api/apps/${app.id}`)
		},
	},
}
</script>

<style scoped>
.cloud_py_api-configuration {
	margin: 20px;
	text-align: center;
}

h2 {
	margin: 20px 0;
}

.apps-list {
	margin: 20px 0;
}

.registered-app {
	border: 1px solid #eee;
	padding: 10px 15px;
	margin: 10px 0;
	border-radius: 5px;
}
</style>
