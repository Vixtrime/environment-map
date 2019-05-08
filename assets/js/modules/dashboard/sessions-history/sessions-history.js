import Vue from 'vue'
import SessionsHistoryModule from './SessionsHistoryModule';


var SessionsHistory = new Vue({
    el: '#landing',
    components: {SessionsHistoryModule},
    render: a => a(SessionsHistoryModule),
});
