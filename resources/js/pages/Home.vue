<template>
<div class="container">

    <h1 class="text-center">Job Search</h1>

    <div :class="[load ? 'd-none': '' ,'stages-container']">
        <div class="stage-parent" v-for="stage in stages" :key="stage.id">
            <Stage
            @getJobs($event)="getStages"
            v-bind:jobs="stage.jobs"
            v-bind:stage="stage"
            />
           

        </div>
    </div>

    <div :class="[load ? '': 'd-none' ,'stages-container']" >
        <div class="stage-parent" v-for="stage in oldStages" :key="stage.id">
            <Stage
            @getJobs($event)="getStages"
            v-bind:jobs="stage.jobs"
            v-bind:stage="stage"
            />
           

        </div>
    </div>
<!-- 
    <Modal 
    v-else
    v-bind:load="load"
    v-bind:deleteJob="deleteJob"
    /> -->
</div>

</template>

<script>
import Stage from './components/Stage.vue';
import Modal from './components/Modal.vue';
    export default {
        name:'Home',
        components: {
          Stage,
          Modal
        },
        data()  {
            return {
                stages: [],
                oldStages: [],
                showModal:false,
                jobs:[],
                load: false,
                deleteJob: false
            }
        },
        methods: {
           loading() {
            console.log('loading');
            this.load = false;
           },
            getStages(evt) {
                //this.load = true;
                if(!isNaN(evt)) {
                    this.deleteJob = true;
                }
                this.oldStages = this.stages;
                this.stages = [];
                axios.get('/api/stage')
                .then((res) => {
                   
                    this.stages = res.data;
                    setTimeout(() => {this.load = false}, 2000);
                   
                    
                })
                .catch((err) => {
                    console.log(err);
                })
            },

            getJobs() {
                axios.get('/api/job')
                .then((response) => {
                    
                    this.jobs = response.data;
                })
                .catch((err) => {
                    console.log(err);
                })
            },
            logStuff(stuff) {
                console.log(stuff);
            }
            
        },
        mounted() {
            
            this.getStages();
            
            window.Echo.channel('jobChannel')
                .listen('Job', (event) => {
                    if(event.Job){
                        this.getStages();
                       
                    }
                })
        },
        computed: {
            
        }
        
    }
</script>


<style lang="scss">

@import '../../sass/app.scss';

.container {
    width: 90%;
    margin: auto;
}

.stages-container {
    display: flex;
    justify-content: space-evenly;

    .stage-parent {
        margin-right: 5px;
        margin-left: 5px;
        width: calc((100% / 4) - 10px);
    }
    
}



</style>

