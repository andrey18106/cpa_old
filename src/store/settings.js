/**
 * @copyright Copyright (c) 2021-2022 Andrey Borysenko <andrey18106x@gmail.com>
 *
 * @copyright Copyright (c) 2021-2022 Alexander Piskun <bigcat88@icloud.com>
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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

const state = {
	settings: [],
}

const mutations = {
	setSettings(state, settings) {
		state.settings = settings
	},
	setSetting(state, setting) {
		const settingIndex = state.settings.findIndex(s => s.name === setting.name)
		const newSettings = state.settings
		newSettings[settingIndex] = setting
		state.settings = newSettings
	},
	updateSetting(state, setting) {
		const settingIndex = state.settings.findIndex(s => s.name === setting.name)
		if (settingIndex !== -1) {
			const settings = state.settings
			settings[settingIndex] = setting
			state.settings = settings
		}
	},
}

const getters = {
	settings: state => state.settings,
	settingByName: state => name => state.settings.find(setting => setting.name === name),
}

const actions = {
	setSettings(context, settings) {
		context.commit('setSettings', settings)
	},
	setSetting(context, setting) {
		context.commit('setSetting', setting)
	},
	updateSetting(context, setting) {
		context.commit('updateSetting', setting)
	},
}

export default { state, mutations, getters, actions }
