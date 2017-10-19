<template>
    <div class="modal is-large is-active" v-if="this.$parent.modalOpen != ''">
        <div class="modal-background" @click="toggleModal"></div>
        <div class="modal-content large">
            <div class="video-wrapper" v-html="content"></div>
        </div>
        <button class="modal-close is-large" @click="toggleModal"></button>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                showModal: false,
                embedContent: ''
            }
        },
        computed: {
            content() {
                return this.$parent.modalContent;
            }
        },
        methods: {
            toggleModal() {
                this.showModal = !this.showModal;
                if (this.$parent.modalOpen !== '') {
                    this.$parent.modalOpen = ''
                }
            }
        },

        mounted() {

            this.$parent.$on('vmloaded', function (vm) {
                client = vm.client;
                openthis = vm.openthis;
                width = vm.width;
                captions = vm.captions;
                disclaimer = vm.disclaimer;
                social = vm.social;
                target_div = vm.target_div;
                secure = vm.secure;
                lang = vm.lang;
                fullscreen = vm.fullscreen;
                autoplay = vm.autoplay;
                menuaccess = vm.menuaccess;
                audio = vm.audio;
                brochure = true;
                subtitles = true;
                markup = false;
                search = false;
                sections = false;

                vm_open();

            });

            this.$parent.$on('toggleModal', function (modal, code) {
                this.modalOpen = modal;
                if (this.modalOpen === 'youtube') {
                    this.modalContent = '<iframe src="https://www.youtube-nocookie.com/embed/' + code + '?rel=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allowfullscreen="allowfullscreen" ></iframe>';
                }
                if (this.modalOpen === 'viewmedica') {

                    this.modalContent = '<div id="' + code + '" ></div>';

                    var vmconfig = {
                        client: "6053",
                        openthis: code,
                        width: 720,
                        captions: true,
                        disclaimer: true,
                        social: true,
                        target_div: code,
                        secure: true,
                        autoplay: true,
                        menuaccess: false,
                        lang: "en",
                        fullscreen: true,
                        audio: true,
                        brochure: true,
                        subtitles: true,
                        markup: false,
                        search: false,
                        sections: false
                    }

                    this.$emit('vmloaded', vmconfig);

                }
            });

        },

        created() {
            var vm = document.createElement('script');
            vm.type = 'text/javascript';
            vm.src = 'https://www.swarminteractive.com/js/vm.js';
            document.body.appendChild(vm);
        }

    }
</script>