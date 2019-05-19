<template>
    <div>
        <h2 style="margin: 15px"></h2>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="m-0">Данные текущей сессии</h5>
                    </div>
                    <div class="card-body">
                        <l-map :zoom="zoom" :center="center"
                               style="height: calc(100vh - 240px); border: 1px solid rgba(189, 189, 189, 0.5); border-radius: 1%">
                            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
<!--                            <l-marker :lat-lng="marker">-->
<!--                                <l-popup :content="''"></l-popup>-->
<!--                            </l-marker>-->
                            <l-marker v-for="item in markers" :key="item.id" :lat-lng="item.latlng"
                                      @l-add="$event.target.openPopup()">
                                <l-popup :content="item.content"></l-popup>
                            </l-marker>
                        </l-map>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
<!--                <div class="card" style="height: calc(100vh - 120px);">-->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="m-0" v-if="!sessionStatus">Начать новую сессию</h5>
                        <h5 class="m-0" v-if="sessionStatus">Текущая сессия: {{ formData.sessionName.data }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-row" v-if="!sessionStatus">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="session-name" placeholder="Имя сессии"
                                       v-model="formData.sessionName.data">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group col-md-12 m-0">
                        <textarea rows="3" type="text" class="form-control" id="session-description"
                                  placeholder="Описание сесии"
                                  v-model="formData.sessionDescription.data"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="form-row" v-if="sessionStatus">
                            <div class="form-group col-md-12">
                                {{ formData.sessionDescription.data}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <div class="form-row" v-if="sessionStatus">
                            <div class="form-group col-md-12 m-0">
                                <button type="button" class="btn btn-pill btn-primary"
                                        @click.self.prevent="postSessionData">
                                    Симулировать подачу данных с дрона
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="form-group col-md-12 m-0" v-if="!sessionStatus">
                            <button type="button" class="btn btn-pill btn-primary"
                                    @click.self.prevent="createSession">
                                Подтвердить
                            </button>
                        </div>
                        <div class="form-row" v-if="sessionStatus">
                            <div class="form-group col-md-12 m-0">
                                <button type="button" class="btn btn-pill btn-primary"
                                        @click.self.prevent="populateMarkers">
                                    <!--                                        @click.self.prevent="closeSession">-->
                                    Завершить сессию
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {LMap, LTileLayer, LMarker, LPopup} from 'vue2-leaflet';
    import axios from 'axios'
    import {dataset} from "../current-session";

    export default {
        components: {
            LMap,
            LTileLayer,
            LMarker,
            LPopup
        },
        data() {
            return {

                message: '',
                sessionId: null,
                sessionStatus: false,

                requestToken: '',
                zoom: 16,
                center: L.latLng(49.998954, 36.2519),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker: L.latLng(49.998954, 36.2525),
                markers: [],
                testDataset: dataset,

                formData:
                    {
                        sessionName:
                            {
                                data: '',
                                invalid: ''
                            },
                        sessionDescription:
                            {
                                data: '',
                                invalid: ''
                            },
                    },

                dataset: [],

            }
        },
        beforeCreate() {
            axios.get('/api/v1/session/get-active').then(response => {
                for (let field in response['data']) {
                    if (response['data'].hasOwnProperty(field)) {
                        if (this.formData[field]) {
                            this.formData[field].data = response['data'][field];
                        } else if (this.hasOwnProperty(field)) {
                            this[field] = response['data'][field];
                        }
                    }
                }
            });
        },
        created() {
            let vm = this;

            function refreshData() {

                function query() {
                    if (!vm.sessionStatus) return;
                    axios.get('/api/v1/session-data/get-active/6', {}).then(response => {
                        // Передавать динамический id
                        vm.dataset = response['data'];
                    });
                }

                setInterval(query, 1000);
            }

            refreshData();

        },
        mounted() {


            // this.markers.push({
            //     id: 1,
            //     latlng: L.latLng(49.998954, 36.2519),
            //     content: 'Hi! this is my popup data'
            //
            // });

        },
        methods: {
            createSession() {
                axios.post('/api/v1/session/create', {
                    name: this.formData.sessionName.data,
                    description: this.formData.sessionDescription.data
                }).then(response => {
                    for (let field in response['data']) {
                        if (response['data'].hasOwnProperty(field)) {
                            if (this.formData[field]) {
                                this.formData[field].data = response['data'][field];
                            } else if (this.hasOwnProperty(field)) {
                                this[field] = response['data'][field];
                            }
                        }
                    }
                });
            },
            closeSession() {
                this.sessionStatus = false;
                axios.post('/api/v1/session/close/' + this.sessionId, {});
                for (let field in this.formData) {
                    if (this.formData.hasOwnProperty(field)) {
                        this.formData[field].data = '';
                    }
                }
            },
            postSessionData() {
                axios.post('/api/v1/session-data/post',
                    this.testDataset
                );
            },
            getActiveSessionData() {
                axios.get('/api/v1/session-data/get-active/1')
            },
            populateMarkers() {
                for (let datasetKey in this.dataset) {
                    for (let sensor in this.dataset[datasetKey]['data']) {

                        let coordinateKey = getCoordinateIfExist(this.markers, this.dataset[datasetKey]['coordinates']);

                        if (coordinateKey === 'not exist') {
                            this.markers.push({
                                latlng: L.latLng(this.dataset[datasetKey]['coordinates']),
                                content: sensor + ': ' + this.dataset[datasetKey]['data'][sensor] + ';' + '</br>'
                            });
                        } else {
                            this.markers[coordinateKey]['content'] += sensor + ': ' + this.dataset[datasetKey]['data'][sensor] + ';' + '</br>';
                        }


                    }
                }
            }
        }
    }

    function getCoordinateIfExist(markers, neededCoordinate) {
        for (let markerKey in markers) {
            if (markers[markerKey]['latlng']['lat'] === neededCoordinate[0]
                && markers[markerKey]['latlng']['lng'] === neededCoordinate[1]) {
                return markerKey;
            }
        }
        return 'not exist';
    }

</script>

<style scoped>
</style>