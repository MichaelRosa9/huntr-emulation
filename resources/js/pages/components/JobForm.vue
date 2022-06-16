<template>
    <div class="form">
        <div class="d-flex-justify-between form-group">
            <div style="width: 33%;">
                <label for="title">Ruolo</label>
                <input v-model="form.title" name="title" type="text" placeholder="Inserisci ruolo" required>

            </div>
            <div style="width: 33%;">
                <label for="company">Azienda</label>
                <input v-model="form.company" name="company" type="text" placeholder="Inserisci azienda" required>

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
            <textarea v-model="form.description" name="description" id="" cols="30" rows="10" required></textarea>
        </div>

        <button v-if="newJobFlag" @click="saveJob">Salva</button>
        <button v-else @click="updateJob">Modifica</button>
        
    </div>

</template>

<script>
export default {
    name: 'Modal',
    props: {
        newJobFlag: Boolean,
        job:Object,
        stage_id: Number,
        
    },
    data () {
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
        }
    },
    methods: {
        closeModal() {
            this.$emit('toggleModal');
        },
        fillForm() {
            if(this.job) {
                this.form = this.job;
            }
        },
        saveJob() {
                axios.post("/api/job", this.form)
                .then(response => {

                    this.$emit('getJobs');
                    this.closeModal();
                })
                .catch(error => {
                    console.log(error);
                });
                
        },
        updateJob() {
            axios.patch("/api/job", this.form)
            .then(response => {
                this.$emit('getJob');
                this.closeModal();
            })
            .catch(error => {
                console.log(error);
            });
            
        }
    },
    mounted() {
        this.fillForm()
    }
    
}
</script>
<style lang="scss" scoped>

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

</style>