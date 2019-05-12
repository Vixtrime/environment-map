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
        Ammonia: {
            6.123: [50.000047, 36.249384]
        },
        Sulfide: {
            1.3: [50.000047, 36.249384]
        },
        CarbonDioxide: {
            311: [50.000047, 36.249384]
        }
    },
    {
        Ammonia: {
            5.124: [49.999956, 36.248561]
        },
        Sulfide: {
            1.4: [49.999956, 36.248561]
        },
        CarbonDioxide: {
            422: [49.999956, 36.248561]
        }
    },
    // {
    //     Ammonia: {
    //         4: [49.999637, 36.248338]
    //     },
    //     Sulfide: {
    //         1.1: [49.999637, 36.248338]
    //     },
    //     CarbonDioxide: {
    //         293: [49.999637, 36.248338]
    //     }
    // },
    // {
    //     Ammonia: {
    //         5: [49.999071, 36.248839]
    //     },
    //     Sulfide: {
    //         1.7: [49.999071, 36.248839]
    //     },
    //     CarbonDioxide: {
    //         600: [49.999071, 36.248839]
    //     }
    // },
    // {
    //     Ammonia: {
    //         3.4: [49.999483, 36.249585]
    //     },
    //     Sulfide: {
    //         0.8: [49.999483, 36.249585]
    //     },
    //     CarbonDioxide: {
    //         452: [49.999483, 36.249585]
    //     }
    // },
];
