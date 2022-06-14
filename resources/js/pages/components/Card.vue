<template>
<div>
    <div class="card">
        <div class="delete" @click="deleteJob = true">
            <i class="bi bi-trash"></i>
        </div>
        <div class="card-body" @click="updateModal = true">
            <div class="header">
                
                <div class="title">
                    {{job.title}}
                </div>

                <div class="company">
                    {{job.company}}
                </div>

            </div>
            
        </div>

    </div>
    <Modal
    v-if="updateModal"
    v-bind:job="this.job"
    @toggleModal="listenModal"
    />

    <Modal
    v-if="deleteJob"
    v-bind:deleteJob="deleteJob"
    v-bind:job="this.job"
    @toggleModal="listenModal"
    />
    
</div>
</template>

<script>
import Modal from './Modal.vue'
    export default {
        name: 'Card',
        components: {
            Modal
        },
        props: {
            job:Object,
            showModal: Boolean
        },
        data () {
            return {
                updateModal: false,
                deleteJob: false
            }
        },
        methods: {
            logStuff(stuff) {
                console.log(stuff);
            },
            listenModal() {
                if(this.updateModal) {
                    this.updateModal = false;
                }
                if(this.deleteJob) {
                    this.deleteJob = false;
                }
            },
           
        },
        mounted() {
            
        }
    }
</script>

<style lang="scss" scoped>

    .card {
        position: relative;
        margin-bottom: 5px;
        padding: 10px;
        border-radius: 5px;
        background-color:rgb(57, 57, 233);
        
        .delete {
            position: absolute;
            top:10px;
            right: 10px;
            z-index: 9;

        }
        .card-body {
            .title {
                font-size: 2.3em;
                color: white;
            }
            .company {
                font-size: 1.2em;
                color: lightgray;
            }
            
        }
        &:hover {
            cursor: pointer;
        }
    }
</style>
