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
            }
        },
        computed: {
            content(){
                return this.$parent.modalContent;
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

            this.$parent.$on('toggleModal', function (modal,code) {
                this.modalOpen = modal;
                if(this.modalOpen === 'youtube'){
                    this.modalContent = '<iframe src="https://www.youtube-nocookie.com/embed/' + code + '?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen="allowfullscreen" ></iframe>';
                }
                if(this.modalOpen === 'viewmedica'){
                    this.modalContent = '<iframe frameborder="0" webkitallowfullscreen="always" mozallowfullscreen="always" title="ViewMedica 8 Video Player" allowfullscreen="always" id="viewmedica_' + code + '" src="https://swarminteractive.com/vm/viewmedica/embed/?client=4725&amp;lang=en&amp;openthis=' + code + '&amp;embedded=https%3A%2F%2Fboneandjointclinicbr.com%2Fvideos%2F&amp;fsmode=on&amp;sec=1&amp;ref=FwOvI%2Bmy2CTDu8rahHcxcW9hJcsGTfMiXJ8D7mfJrLn1BhCblzYTrgzZnsMW%2FHk5baz7io5tZ2lt17MbYFdk2AUn4CGlMw7i8Q8Hhn9JSZH2Xap6oHvmMf7Wu7GVg2oySCI8Qakvw0ZYNSCQi53gLr3JmSN3PpUOvJV6sfSCY%2FY%3D&amp;sec=1" ></iframe>';
                }
            });

        },

        created(){
            let viewmedica = document.createElement('script');
            viewmedica.setAttribute('src',"//www.swarminteractive.com/js/vm.js");
            document.head.appendChild(viewmedica);
        }

    }
</script>