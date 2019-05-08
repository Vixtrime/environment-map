const jQuery = require('jquery');
global.jQuery = jQuery;
const axios = require('axios');
global.axios = axios;


import Vue from 'vue';
import MainModule from './MainModule';

export const barComponentsBus = new Vue();
export var titles =
    {
        'current-session': 'Текущая сессия',
        'drone-control': 'Управление дроном',
        'sessions-history': 'История сессий'
    };


Vue.component('current-session', () => import('../current-session/CurrentSessionModule'));
Vue.component('drone-control', () => import('../drone-control/DroneControlModule'));
Vue.component('sessions-history', () => import('../sessions-history/SessionsHistoryModule'));


var Main = new Vue({
    el: '#main',
    components: {MainModule},
    render: a => a(MainModule),
});


// ********* Include libs ********* //
require('bootstrap/dist/js/bootstrap.bundle.min');
require('shards-ui/dist/js/shards.min');
