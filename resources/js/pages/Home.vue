<template>
<div class="container">
    <h1 class="text-center">Job Search</h1>

    <!-- <Stage
    v-for="stage in stages" :key="stage.id"
    v-bind:name="stage.name"
    v-bind:jobs="jobs"
    v-bind:stage_id="stage.id"
    
    /> -->
<div class="stages-container">
    <div class="stage-parent" v-for="stage in stages" :key="stage.id">
        <Stage
        @getJobs="getJobs"
        v-bind:name="stage.name"
        v-bind:jobs="filterJobs(stage.id)"
        v-bind:stage_id="stage.id"
        />
    </div>
</div>
</div>

</template>

<script>

import Stage from './components/Stage.vue';
    export default {
        name:'Home',
        components: {
          Stage
        },
        data()  {
            return {
                stages: [],
                showModal:false,
                jobs:[],
            }
        },
        methods: {
            getStages() {
                axios.get('/api/stage')
                .then((res) => {
                   
                    this.stages = res.data;
                    
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
            filterJobs(stage_id) {
                
                let filtered_jobs = this.jobs.filter(job => {
                    return job.stage_id == stage_id;
                });
               
               return filtered_jobs;
                /* return filtered_jobs.filter(job => {
                    return job.stage_id == stage_id;
                }); */
            },
            logStuff(stuff) {
                console.log(stuff);
            }
            
        },
        mounted() {
            this.getStages();
            this.getJobs();
            window.Echo.channel('jobChannel')
                .listen('Job', (e) => {
                    console.log(e);
                })
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

