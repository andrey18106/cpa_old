const path = require('path')
const webpackConfig = require('@nextcloud/webpack-vue-config')
const webpackRules = require('@nextcloud/webpack-vue-config/rules')

webpackConfig.entry['configuration'] = path.join(__dirname, 'src', 'main-configuration.js')

webpackConfig.module.rules = Object.values(webpackRules)

module.exports = webpackConfig
