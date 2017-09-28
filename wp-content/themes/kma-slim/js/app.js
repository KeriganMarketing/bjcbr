window.Vue = require('vue');

import message from './components/message.vue';
import modal from './components/modal.vue';
import tabs from './components/tabs.vue';
import tab from './components/tab.vue';
import slider from './components/slider.vue';
import slide from './components/slide.vue';
import GoogleMap from './components/GoogleMap.vue';

var app = new Vue({

    el: '#app',

    components: {
        message,
        modal,
        tabs,
        tab,
        slider,
        slide,
        GoogleMap
    },

    data: {
        isOpen: false,
        modalOpen: ''
    },

    methods: {

        toggleMenu(){
            this.isOpen = !this.isOpen;
        },

    },

});

