import Vue from 'vue'
import CurrentSessionModule from './CurrentSessionModule';


var CurrentSession = new Vue({
    el: '#landing',
    components: {CurrentSessionModule},
    render: a => a(CurrentSessionModule),
});
