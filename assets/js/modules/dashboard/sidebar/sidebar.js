// const jQuery = require('jquery');
// global.jQuery = jQuery;
// const axios = require('axios');
// global.axios = axios;

import Vue from 'vue'
import SideBarModule from './SideBarModule';


Vue.component('channel-analytics', () => import('../channel_analytics/components/ChannelAnalytics'));


var Sidebar = new Vue({
    el: '#userSettings',
    components: {SideBarModule},
    render: a => a(SideBarModule),
});


// ********* Include libs ********* //
// require('bootstrap');
// require('chart.js');
