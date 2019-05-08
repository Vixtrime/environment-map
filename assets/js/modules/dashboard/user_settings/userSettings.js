// const jQuery = require('jquery');
// global.jQuery = jQuery;
// const axios = require('axios');
// global.axios = axios;

import Vue from 'vue'
import UserSettingsModule from './UserSettingsModule';


var UserSettings = new Vue({
    el: '#landing',
    components: {UserSettingsModule},
    render: a => a(UserSettingsModule),
});

// ********* Include libs ********* //
// require('bootstrap');
// require('chart.js');
