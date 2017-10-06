<template>
    <div class="google-map" :id="mapName">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: [
            'latitude',
            'longitude',
            'zoom'
        ],

        data: function () {
            return {
                mapName: this.name + "-map",
                markers: []
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
                        "featureType": "administrative",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.man_made",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            },
                            {
                                "color": "#efe9cf"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#e6e2b7"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            },
                            {
                                "color": "#e2d199"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c4d7cd"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e6e2b7"
                            },
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            },
                            {
                                "color": "#333333"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.text",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": "0"
                            },
                            {
                                "lightness": "0"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            },
                            {
                                "color": "#f1f1f1"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#9fc0e9"
                            }
                        ]
                    }
                ]
            }
            const map = new google.maps.Map(element, options);
            this.markers = this.$children;
            this.markers.forEach(coord => {
                const position = new google.maps.LatLng(coord.latitude, coord.longitude);
                const marker = new google.maps.Marker({
                    position,
                    map
                });
            });
        },

    }
</script>