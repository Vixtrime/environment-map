import Vue from 'vue'
import CurrentSessionModule from './CurrentSessionModule';


import {Icon} from 'leaflet'
import 'leaflet/dist/leaflet.css'

delete Icon.Default.prototype._getIconUrl;

Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png')
});


var CurrentSession = new Vue({
    el: '#map',
    components: {CurrentSessionModule},
    render: a => a(CurrentSessionModule),
});

