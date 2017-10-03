window.Vue = require('vue');

import message from './components/message.vue';
import modal from './components/modal.vue';
import tabs from './components/tabs.vue';
import tab from './components/tab.vue';
import slider from './components/slider.vue';
import slide from './components/slide.vue';
import GoogleMap from './components/GoogleMap.vue';
import Slick from 'vue-slick';

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
        slickOptions: {
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 2000,
            prevArrow: '<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>',
            nextArrow: '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>',
            responsive: [
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
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

