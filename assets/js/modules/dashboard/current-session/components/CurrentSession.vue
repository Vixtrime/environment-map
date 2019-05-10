<template>
    <div>
        <h1>Данные текущей сессии</h1>
        <div class="row" style="height: 400px; width: 700px">
            <div class="col-lg-12">
                <l-map :zoom="zoom" :center="center">
                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                    <l-marker :lat-lng="marker"></l-marker>
                </l-map>
            </div>
        </div>
    </div>
</template>

<script>

    import {LMap, LTileLayer, LMarker} from 'vue2-leaflet';

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
                zoom: 16,
                center: L.latLng(49.998954, 36.2519),
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                marker: L.latLng(47.413220, -1.219482),
            }
        },
    }
</script>

<style scoped>
</style>