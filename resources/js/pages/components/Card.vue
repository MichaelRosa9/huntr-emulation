<template>
    <div>

        <div class="card" @click="updateModal = true">
            <div class="header">
                <div class="delete">
                    <i class="bi bi-trash"></i>
                </div>
                <div class="title">
                    {{job.title}}
                </div>

                <div class="company">
                    {{job.company}}
                </div>

            </div>
            
        </div>

        <Modal 
        v-if="updateModal"
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
            }
        },
        methods: {
            logStuff(stuff) {
                console.log(stuff);
            },
            listenModal() {
                this.updateModal = false;
            },
            deleteJob() {
                axios.delete('/api/job/' + this.job.id)
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
            }
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
        .title {
            font-size: 2.3em;
            color: white;
        }
        .company {
            font-size: 1.2em;
            color: lightgray;
        }
        
        &:hover {
            cursor: pointer;
        }
    }
</style>
