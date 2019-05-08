<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
                    <div class="main-navbar">
                        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                                <div class="d-table m-auto">
                                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                                         src="../../../../../images/AP-logo.png" alt="Shards Dashboard">
                                    <span class="d-none d-md-inline ml-1">АП-15б</span>
                                </div>
                            </a>
                            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                                <i class="material-icons">&#xE5C4;</i>
                            </a>
                        </nav>
                    </div>
                    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                        <div class="input-group input-group-seamless ml-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                            <input class="navbar-search form-control" type="text" placeholder="Search for something..."
                                   aria-label="Search"></div>
                    </form>
                    <div class="nav-wrapper">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="#current-session" id="current-session"
                                   @click="changeBoard('current-session')">
                                    <i class="far fa-chart-bar sidebar-icon"></i>
                                    <span>Текущая сессия</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#sessions-history" id="sessions-history"
                                   @click="changeBoard('sessions-history')">
                                    <i class="material-icons">vertical_split</i>
                                    <span>История сессий</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#drone-control" id="drone-control"
                                   @click="changeBoard('drone-control')">
                                    <i class="far fa-compass sidebar-icon"></i>
                                    <span>Управление дроном</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</template>

<script>
    import {barComponentsBus} from "../../main/main";

    export default {
        data() {
            return {}
        },
        created() {
            barComponentsBus.$on('boardChanged', (board) => {
                Array.from(document.getElementsByClassName('nav-link')).forEach(function (element) {
                    if (element) element.classList.remove('active');
                });
                let elem = document.getElementById(board);
                if (elem) elem.classList.add('active');
            })
        },
        methods: {
            changeBoard(board) {
                barComponentsBus.$emit('boardChanged', board);
            },
        }
    }
</script>
