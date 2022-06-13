<template>
    <div class="stage">
        <div class="name text-center">
            {{name}}
        </div>

        <div class="body">

                
            <div class="add-job"
            @click="showModal = true"
            >
                <i class="bi bi-plus-lg"></i>
            </div>

            <div class=""
            v-for="job in jobs" :key="'job_id' + job.id"
            
            >
                <Card
                v-bind:job="job"
                v-bind:showModal="showModal"
                />
            </div>
        </div>

        <Modal 
        v-if="showModal"
        v-bind:stage_id="this.stage_id"
        v-bind:newJobFlag="newJobFlag"
        @toggleModal="listenModal"
        />

    </div>

</template>

<script>
import Card from './Card.vue'
import Modal from './Modal.vue'
    export default {
        name: 'Stage',
        components : {
            Card,
            Modal
        },
        
        data() {
            return {
                form: {
                    company: "",
                    stage_id: this.stage_id,
                    title:"",
                    url:"",
                    salary: "",
                    location: "",
                    description: "",
                    
                },
                modalSwitch: false,
                newJobFlag: true,
                updateJobFlag: false,

                showModal:false,
            }
        },
        props: {
            name:{
                type:String
            },
            stage_id:{
                type: Number
            },
            jobs:{
                type: Array
            }
        },
        methods :{
            
            listenModal() {
                this.showModal = false;
            },
            logStuff(stuff) {
                console.log(stuff);
            }
        },
        mounted() {
            
        },
        
    }
</script>

<style lang="scss" scoped>


.stage { 
    display: inline-block;
    /* margin-right: 5px;
    margin-left: 5px; */
    width: 100%;
    height: 80vh;
    padding: 5px;
    background-color: aliceblue;
    border-radius: 10px;
    border: solid 1px lightgray;
    
    .name {
        width: 80%;
        margin:  0 auto 20px;
        font-size:2em;
        transition: 0.7s;

        &:hover {
            background-color: rgba($color: #cacaca, $alpha: .5);
            cursor: pointer;
        }
    }
    .add-job {
        margin-bottom: 20px;
        border: solid 1px lightgrey;
        border-radius: 3px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: grey;
        transition: 0.5s;
        &:hover {
            box-shadow: lightgrey 1px 1px .5px;
            cursor: pointer;
        }
    }
    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: 998;
        background-color: rgba(76, 0, 255, 0.3);
    }

    .modal {
        position: fixed;
        top: 20%;
        left: 20%;
        transform: translate(-20%, -20%);
        z-index: 999;
        width: 100%;
        max-width: 90%;
        background-color: #fff;
        border: solid 1px lightgray;
        border-radius: 4px;
        padding: 25px;

        .close {
            display: inline;
            &:hover {
                cursor: pointer;
            }
        }
        .form {
            .form-group {
                color: rgb(85, 85, 85);
                margin-bottom: 10px;

            }

            input {
                height: 30px;
                border: solid 1px grey;
                border-radius: 5px;
                
            }

            label {
                display: block;
            }
            input,
            textarea {
                width: 100%;
                padding: 10px;
                outline: none;
            }
            .w-50 {
                width: 50%;
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

    
} 
</style>
