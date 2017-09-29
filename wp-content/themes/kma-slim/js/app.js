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
        modalOpen: '',
        scrollPosition: 0,
        footerStuck: false,
        clientHeight: 0,
        windowHeight: 0
    },

    methods: {

        toggleMenu(){
            this.isOpen = !this.isOpen;
        },

        handleScroll(){
            this.scrollPosition = window.scrollY;
        }

    },

    mounted: function() {
        this.footerStuck = window.innerHeight > this.$root.$el.clientHeight ? true : false;
        this.clientHeight = this.$root.$el.clientHeight;
        this.windowHeight = window.innerHeight;
    },

    created: function () {
        window.addEventListener('scroll', this.handleScroll);
    },

    destroyed: function () {
        window.removeEventListener('scroll', this.handleScroll);
    }

});

