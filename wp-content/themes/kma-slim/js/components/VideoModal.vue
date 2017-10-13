<template>
    <div class="modal is-large is-active" v-if="this.$parent.modalOpen != ''">
        <div class="modal-background" @click="toggleModal"></div>
        <div class="modal-content large">
            <div class="video-wrapper">
                <iframe :src="'https://www.youtube-nocookie.com/embed/' + this.$parent.youTubeCode + '?rel=0&amp;showinfo=0'" frameborder="0" allowfullscreen="allowfullscreen" class="embed-responsive-item"></iframe>
            </div>
        </div>
        <button class="modal-close is-large" @click="toggleModal"></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showModal: false
            }
        },
        methods: {
            toggleModal(){
                this.showModal = !this.showModal;
                if(this.$parent.modalOpen !== ''){
                    this.$parent.modalOpen = ''
                }
            }
        },

        mounted() {
            //console.log('Component mounted.');

            this.$parent.$on('toggleModal', function (modal,code) {
                this.modalOpen = modal;
                this.youTubeCode = code;
            });

        }
    }
</script>