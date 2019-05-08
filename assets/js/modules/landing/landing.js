const jQuery = require('jquery');
global.jQuery = jQuery;
const axios = require('axios');
global.axios = axios;

import Vue from 'vue'
import LandingModule from './LandingModule';


var Landing = new Vue({
    el: '#landing',
    components: {LandingModule},
    render: a => a(LandingModule),
});

// ********* Include libs ********* //
require('bootstrap/dist/js/bootstrap.bundle.min');

