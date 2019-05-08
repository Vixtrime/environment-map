// const jQuery = require('jquery');
// global.jQuery = jQuery;
// const axios = require('axios');
// global.axios = axios;

import Vue from 'vue'
import NavBarModule from './NavBarModule';


var NavBar = new Vue({
    el: '#userSettings',
    components: {NavBarModule},
    render: a => a(NavBarModule),
});


// ********* Include libs ********* //
// require('bootstrap');
// require('chart.js');
