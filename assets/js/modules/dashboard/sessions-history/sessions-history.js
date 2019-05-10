import Vue from 'vue'
import SessionsHistoryModule from './SessionsHistoryModule';

import {Icon} from 'leaflet'
import 'leaflet/dist/leaflet.css'

delete Icon.Default.prototype._getIconUrl;

Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png')
});


var SessionsHistory = new Vue({
    el: '#landing',
    components: {SessionsHistoryModule},
    render: a => a(SessionsHistoryModule),
});
