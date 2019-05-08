<template>
    <div>
        <SideBarModule></SideBarModule>
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            <div class="main-navbar sticky-top bg-white">
                <NavBarModule></NavBarModule>
            </div>

            <div class="main-content-container container-fluid px-4">

                <current-session v-if="board === 'current-session'"></current-session>
                <drone-control v-if="board === 'drone-control'"></drone-control>
                <sessions-history v-if="board === 'sessions-history'"></sessions-history>
            </div>
        </main>
    </div>
</template>

<script>

    import NavBarModule from '../../navbar/NavBarModule';
    import SideBarModule from '../../sidebar/SideBarModule';

    import {barComponentsBus, titles} from "../main";

    export default {
        components: {
            NavBarModule,
            SideBarModule
        },
        data() {
            return {
                board: 'current-session',
                data: urls
            }
        },
        beforeMount(){
          document.title = titles[this.board];
        },
        created() {
            barComponentsBus.$on('boardChanged', (data) => {
                this.board = data;
                document.title = titles[data];
            });
        },
        methods: {}
    }
</script>

