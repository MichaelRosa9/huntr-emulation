<template>
    <div>
         <transition name="fade" appear>
            <div class="modal-overlay" v-if="this.modalSwitch" @click="this.modalControl"></div>
        </transition>

        <transition name="fade" appear>
            <div class="modal" v-if="this.modalSwitch">
                <div class="text-right">
                    <div class="close" @click="this.modalControl"><i class="bi bi-x-lg"></i></div>

                </div>

                <div class="form">
                   
                    <button v-if="newJobFlag" @click="deleteJob">Salva</button>
                    
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name:"Modal",
    data() {
        return {
            modalSwitch: false,
        }
    },
    methods: {
        modalControl(job) {
                this.modalSwitch = !this.modalSwitch;
                
                if(job == 'new') {           
                           
                    this.newJobFlag = true;
                    this.updateJobFlag = false;
                    
                } else {
                    this.form = job;
                    this.newJobFlag = false;
                    this.updateJobFlag = true;
                }
                
            },
    },
    mounted() {

    },
}
</script>