window.Vue = require('vue');

import message from './components/message.vue';
import modal from './components/modal.vue';
import tabs from './components/tabs.vue';
import tab from './components/tab.vue';
import slider from './components/slider.vue';
import slide from './components/slide.vue';
import GoogleMap from './components/GoogleMap.vue';
import Slick from 'vue-slick';
import VueParallaxJs from 'vue-parallax-js';

window.Vue.use(VueParallaxJs);

var app = new Vue({

    el: '#app',

    components: {
        'message': message,
        'modal': modal,
        'tabs': tabs,
        'tab': tab,
        'bulma-slider': slider,
        'bulma-slide': slide,
        'google-map': GoogleMap,
        'slick': Slick
    },

    data: {
        isOpen: false,
        modalOpen: '',
        scrollPosition: 0,
        footerStuck: false,
        clientHeight: 0,
        windowHeight: 0,
        windowWidth: 0,
        slickOptions: {
            arrows: true,
            autoplay: true,
            autoplaySpeed: 3000,
            prevArrow: '<span class="bubble-icon left" ><i class="fa" aria-hidden="true">&#9664;</i></span>',
            nextArrow: '<span class="bubble-icon right" ><i class="fa" aria-hidden="true">&#9658;</i></span>',
            slidesToScroll: 1
        }
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
        this.footerStuck = window.innerHeight > this.$root.$el.clientHeight;
        this.clientHeight = this.$root.$el.clientHeight;
        this.windowHeight = window.innerHeight;
        this.windowWidth = window.innerWidth;

        if(this.windowWidth > 1008){
            this.slickOptions.slidesToShow = 3;
            this.$refs.slick.reSlick();
        }
    },

    created: function () {
        window.addEventListener('scroll', this.handleScroll);
    },

    destroyed: function () {
        window.removeEventListener('scroll', this.handleScroll);
    }

});