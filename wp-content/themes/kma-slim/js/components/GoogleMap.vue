<template>
    <div class="google-map" :id="mapName">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'latitude',
            'longitude',
            'zoom'
        ],

        data: function () {
            return {
                mapName: this.name + "-map",
                markers: [],
                pins: []
            }
        },

        mounted: function () {
            const element = document.getElementById(this.mapName)
            const options = {
                zoom: this.zoom,
                center: new google.maps.LatLng(this.latitude,this.longitude),
                disableDefaultUI: true,
                zoomControl: true,
                scaleControl: true,
                styles: [
                    {
                        "featureType": "landscape",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#f7ebcf"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.man_made",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#f7ebcf"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural.landcover",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#f1e7c7"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural.terrain",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#f1e7c7"
                            }
                        ]
                    }
                ]
            }
            const map = new google.maps.Map(element, options);
            const bounds = new google.maps.LatLngBounds();
            this.markers = this.$children;

            for(var i = 0; i < this.markers.length; i++){
                var pin = this.markers[i];
                this.pins.push({
                    latitude: pin._data.markerCoordinates.latitude,
                    longitude: pin._data.markerCoordinates.longitude,
                });

                const position = new google.maps.LatLng(pin.latitude, pin.longitude);
                const marker = new google.maps.Marker({
                    position,
                    map
                });

                const infowindow = new google.maps.InfoWindow({
                    maxWidth: 279,
                    content: pin.$refs.infowindow,
                    title: pin._data.name
                });

                marker.addListener('click', function(){
                    infowindow.open(map, marker);
                });

                bounds.extend(position);
                map.fitBounds(bounds);

            }
        },

    }
</script>