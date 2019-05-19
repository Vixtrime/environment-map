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

[[asdasd => [asdasd => []]],[]]

export var dataset = [
    {
        coordinates: [50.000047, 36.249384],
        data: {
            Ammonia: 6.123,
            Sulfide: 1.3,
            CarbonDioxide: 311
        }
    },
    {
        coordinates: [49.999956, 36.248561],
        data: {
            Ammonia: 5.124,
            Sulfide: 1.4,
            CarbonDioxide: 422
        }
    },
    {
        coordinates: [49.999637, 36.248338],
        data: {
            Ammonia: 4.124,
            Sulfide: 1.187,
            CarbonDioxide: 239
        }
    },
    {
        coordinates: [49.999071, 36.248839],
        data: {
            Ammonia: 2.283,
            Sulfide: 0.288,
            CarbonDioxide: 487
        }
    },
    {
        coordinates: [49.999483, 36.249585],
        data: {
            Ammonia: 8.19,
            Sulfide: 5.902,
            CarbonDioxide: 987
        }
    },
];