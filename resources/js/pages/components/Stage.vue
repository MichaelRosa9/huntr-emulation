<template>
    <div class="stage">
        <div class="name text-center">
            {{name}}
        </div>

        <div class="body">

                
            <div class="add-job"
            @click="modalControl('new')"
            >
                <i class="bi bi-plus-lg"></i>
            </div>

            <div class=""
            v-for="job in jobs" :key="'job_id' + job.id"
            @click="modalControl(job)"
            >
                <Card
                v-bind:job="job"
                />
            </div>
        </div>
    
    <!-- MODAL -->
        <transition name="fade" appear>
            <div class="modal-overlay" v-if="this.modalSwitch" @click="this.modalControl"></div>
        </transition>
        
        <transition name="fade" appear>
            <div class="modal" v-if="this.modalSwitch">
                <div class="text-right">
                    <div class="close" @click="this.modalControl"><i class="bi bi-x-lg"></i></div>

                </div>

                <div class="form">
                    <div class="d-flex-justify-between form-group">
                        <div style="width: 33%;">
                            <label for="title">Ruolo</label>
                            <input v-model="form.title" name="title" type="text" placeholder="Inserisci ruolo">

                        </div>
                        <div style="width: 33%;">
                            <label for="company">Azienda</label>
                            <input v-model="form.company" name="company" type="text" placeholder="Inserisci azienda">

                        </div>

                        <div style="width: 25%;">
                            <label for="salary">Salario</label>
                            <input v-model="form.salary" name="salary" type="text" placeholder="Inserisci salario">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="url">URL</label>
                        <input v-model="form.url" type="text" name="url" placeholder="inserisci URL">
                    </div>

                    <div class="form-group">
                        <label for="location">Indirizzo</label>
                        <input v-model="form.location" type="text" name="location" placeholder="Inserisci indirizzo">
                    </div>

                    <div class="form-group">
                        <label for="description">Desrizione</label>
                        <textarea v-model="form.description" name="description" id="" cols="30" rows="10"></textarea>
                    </div>

                    <button v-if="updateJobFlag" @click="updateJob">Modifica</button>
                    <button v-if="newJobFlag" @click="saveJob">Salva</button>
                    
                </div>
            </div>
        </transition>
    </div>
    <!-- end MODAL -->

</template>

<script>
import Card from './Card.vue'
    export default {
        name: 'Stage',
        components : {
            Card
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
                newJobFlag: false,
                updateJobFlag: false,
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
            saveJob() {
                axios.post("/api/job", this.form)
                .then(response => {

                    console.log(response);
                    this.modalControl();
                    this.updateJobFlag = false;
                    this.newJobFlag = false;
                })
                .catch(error => {
                    console.log(error);
                });
                
            },
            updateJob() {
                axios.patch("/api/job", this.form)
                .then(response => {
                    this.modalControl();
                    this.updateJobFlag = false;
                    this.newJobFlag = false;
                })
                .catch(error => {
                    console.log(error);
                });
                
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
