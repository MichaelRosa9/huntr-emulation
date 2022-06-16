<template>
    <div class="stage">
        <div class="name text-center">
            {{stage.name}}
        </div>

        <div :id="this.stage.id" class="body">

            <div class="add-job"
            @click="showModal = true"
            >
                <i class="bi bi-plus-lg"></i>
            </div>

            <draggable
                class="list-group"
                @add="onAdd"
                :list="arrayList.jobs"
                group="arrayList"
                animation="200"
                :empty-insert-threshold="100"
                @change="update($event, arrayList)"
            >
                <transition-group>
                    <Card
                    v-for="job in this.arrayList.jobs" :key="job.id"
                    v-bind:job="job"
                    v-bind:showModal="showModal"
                    />

                </transition-group>
            
            </draggable>

        </div>

        <Modal 
        v-if="showModal"
        v-bind:stage_id="this.stage.id"
        v-bind:newJobFlag="newJobFlag"
        @toggleModal="listenModal"
        @getJobs="getJobs"
        />

    </div>

</template>

<script>
 import draggable from 'vuedraggable';

import Card from './Card.vue'
import Modal from './Modal.vue'
    export default {
        name: 'Stage',
        components : {
            Card,
            Modal,
            draggable
        },
        
        data() {
            return {
                form: {
                    company: "",
                    stage_id: this.stage.id,
                    title:"",
                    url:"",
                    salary: "",
                    location: "",
                    description: "",
                    
                },
                
                newJobFlag: true,

                showModal:false,
                
                arrayList: {
                    id: this.stage.id,
                    jobs: [],
                },
            }
        },
        props: {
            name:{
                type:String
            },
            stage:{
                type: Object
            },
            jobs:{
                type: Array
            },
            
        },
        methods :{
            onAdd (e) { 
                
                e.item.classList.add('display-none') ;
            },
            getjobToUpdate (old) {
                this.oldStage = old;
            },
            updateStage(job, stage) {
            axios.patch("/api/jobUpdateStage/"+ job.id, stage)
            .then(response => {
                console.log(response);
                this.getJobs();
            })
            .catch(error => {
                console.log(error);
            });
            
            },
            update(evt, list) {
                if(evt.added){
                    let newEvent = {job: evt.added.element, stage: list};
                    //console.log(newEvent.stage.id);
                    this.updateStage(newEvent.job, newEvent.stage)
                }
                if (evt.removed) {
                    let oldEvent = {event: evt.removed, oldList: list};
                    
                }
                
                
                this.$emit('cycleLoop');

            },
            
            listenModal() {
                this.showModal = false;
            },
            logStuff(stuff) {
                console.log(stuff);
            },
            ontheChange(evt) {
                return (evt.draggedContext.element.name!=='apple');
            },
            setList() {
                this.arrayList.jobs = JSON.parse(JSON.stringify(this.jobs))
            },
            getJobs() {
                this.$emit('getJobs');
            }
            
        },
        mounted() {
            this.setList();

        },
        
        computed: {
            
        }
        
    }
</script>

<style lang="scss" scoped>


.stage { 
    display: inline-block;
    
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
     
 .list-group {
    & span {

        height: 300px;
    }
 }
    
} 

.on-drag {
        background-color: grey;
        color: black;
    } 
.display-none { 
    display: none; 
}
</style>
