<template>
    <div>
        <transition name="fade" appear>
            <div class="modal-overlay" @click="closeModal"></div>
        </transition>
        
        <transition name="fade" appear>
            <div :class="[this.deleteJob ? 'modal-sm' : 'modal-lg', 'modal']">
                <div class="text-right">
                    <div class="close" @click="closeModal"><i class="bi bi-x-lg"></i></div>

                </div>

            <div v-if="this.deleteJob">
                <Delete 
                v-bind:job="this.job"
                @toggleModal="closeModal"
                />
            </div>
            <div v-else>
                <Form
                v-bind:newJobFlag="this.newJobFlag"
                v-bind:job="this.job"
                v-bind:stage_id="this.stage_id"
                @toggleModal="closeModal"
                />

            </div>
                
            </div>
        </transition>
    </div>
</template>

<script>
import Form from './JobForm.vue';
import Delete from './DeleteAllert.vue';
export default {
    name: 'Modal',
    components: {
        Form,
        Delete
    },
    props: {
        newJobFlag: Boolean,
        job:Object,
        stage_id: Number,
        deleteJob: Boolean
        
    },
    data () {
        return {
            
        }
    },
    methods: {
        closeModal() {
            this.$emit('toggleModal');
        },
        logStuff(stuff) {
            console.log(stuff);
        }
        
    },
    mounted() {
        this.logStuff(this.deleteJob);
    }
    
}
</script>

<style lang="scss" scoped>

.modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: 98;
        background-color: rgba(76, 0, 255, 0.3);
    }

    .modal {
        position: fixed; 
        z-index: 99;
        background-color: #fff;
        border: solid 1px lightgray;
        border-radius: 4px;
        padding: 25px;

        &.modal-lg {
            top: 20%;
            left: 20%;
            width: 100%;
            max-width: 90%;
            transform: translate(-20%, -20%); 
        }
        &modal-sm {
            top: 50%;
            left: 50%;
            width: 100%;
            max-width: 50%;
            transform: translate(-50%, -50%); 
        }
        

        .close {
            display: inline;
            &:hover {
                cursor: pointer;
            }
        }
        
    }

    /* 
        fade classes are defined by the "name"property in transition tag
    */
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s;
    }

    .fade-enter,
    .fade-leave {
        opacity: 0;
    }
</style>