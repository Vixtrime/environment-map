<template>
    <div>
        <h2 style="margin: 15px">Данные текущей сессии</h2>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8"
                 style="min-height: 450px; padding: 1px; border: solid gray 2px; border-radius: 1%">
                <l-map :zoom="zoom" :center="center">
                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                    <l-marker :lat-lng="marker"></l-marker>
                </l-map>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h4 style="margin-top: 15px" v-if="!sessionStatus">Начать новую сессию</h4>
                <div class="form-row" v-if="!sessionStatus">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="session-name" placeholder="Имя сессии"
                               v-model="formData.sessionName.data">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-md-12">
                        <textarea type="text" class="form-control" id="session-description" placeholder="Описание сесии"
                                  v-model="formData.sessionDescription.data"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="button" class="btn btn-pill btn-primary" @click.self.prevent="createSession">
                            Подтвердить
                        </button>
                    </div>
                </div>
                <h4 style="margin-top: 15px" v-if="sessionStatus">Текущая сессия: sessionName</h4>
                <div class="form-row" v-if="sessionStatus">
                    <div class="form-group col-md-12">
                        <button type="button" class="btn btn-pill btn-primary" @click.self.prevent="closeSession">
                            Завершить сессию
                        </button>
                    </div>
                </div>
                <div class="form-row" v-if="sessionStatus">
                    <div class="form-group col-md-12">
                        <button type="button" class="btn btn-pill btn-primary" @click.self.prevent="droneSimulateData">
                            Симулировать подачу данных с дрона
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    import {LMap, LTileLayer, LMarker} from 'vue2-leaflet';
    import axios from 'axios'

    export default {
        components: {
            LMap,
            LTileLayer,
            LMarker
        },
        mounted() {
            // this.$refs.map.mapObject.invalidateSize();
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
                marker: L.latLng(47.413220, -1.219482),

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
            }
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
            droneSimulateData() {
                axios.post('/dashboard/session/close', {});
            }
        },
        created() {
            let self = this;

            // function refreshData() {
            //
            //     function query() {
            //         if (!self.sessionStatus) return;
            //         axios.get('/dashboard/session/get', {}).then(response => {
            //             console.log(response);
            //         });
            //     }
            //
            //     setInterval(query, 1000);
            // }
            //
            // refreshData();
        }
    }
</script>

<style scoped>
</style>