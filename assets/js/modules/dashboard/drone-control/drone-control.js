import Vue from 'vue'
import DroneControlModule from './DroneControlModule';


var DroneControl = new Vue({
    el: '#landing',
    components: {DroneControlModule},
    render: a => a(DroneControlModule),
});
