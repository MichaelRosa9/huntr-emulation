<template>
    <div>
        <div class="card">
            <div class="header">
                <div class="delete" @click="this.updateJobFlag = false;">
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

    </div>
</template>

<script>
    export default {
        name: 'Card',
        props: {
            job:Object,
        },
        methods: {
            logStuff(stuff) {
                console.log(stuff);
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
