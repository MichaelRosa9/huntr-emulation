<template>
    <div>
        <p>
            Sei sicuro di voler eliminare questo lavoro
        </p>

        <div class="text-right">
            <button @click="deleteJob(job.id)"> Elimina</button>

        </div>
    </div>
</template>
<script>
export default {
    name: 'Delete',
    props: {
        job: Object
    },
    methods: {
        closeModal() {
            this.$emit('toggleModal');
        },
        deleteJob(job_id) {
            console.log(job_id);
            axios.delete('/api/job/' + job_id)
                .then((res) => {
                    this.closeModal();
                })
                .catch(error => {
                console.log(error);
            });
        }
    }
}
</script>