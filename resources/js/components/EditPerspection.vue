<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Update Perspection Data</h5>
                <div>
                    <router-link :to="{name: 'perspections'}" class="btn btn-success">Go Back</router-link>
                </div>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strSuccess}}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strError}}</strong>
            </div>


            <form @submit.prevent="updatePatient" enctype="multipart/form-data">
               <div class="form-group mb-2">
                    <label>Medication</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="medication" placeholder="Enter patient medication">
                </div>

                <div class="form-group mb-2">
                    <label>Starting date</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="startingdate" placeholder="Enter patient starting date">
                </div>

                <div class="form-group mb-2">
                    <label>Duration</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="duration" placeholder="Enter patient duration"></textarea>
                </div>
                 

                <button type="submit" class="btn btn-primary mt-4 mb-4"> Update Perspection</button>

            </form>
            
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            id:'',
            medication: '',
            startingdate:'',
            duration:'',
            strSuccess: '',
            strError: '',
           
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/perspections/edit/${this.$route.params.id}`)
            .then(response => {
                this.medication = response.data['medication'];
                this.startingdate = response.data['startingdate'];
                this.duration = response.data['duration'];
            })
            .catch(function(error) {
                console.log(error);
            });
        })
    },
    methods: {
        
        updatePatient(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                const formData = new FormData();
                formData.append('medication', this.medication);
                formData.append('startingdate', this.startingdate);
                formData.append('duration', this.duration);
                this.$axios.post(`/api/perspections/update/${this.$route.params.id}`, formData, config)
                .then(response => {
                    existingObj.strError = "";
                    existingObj.strSuccess = response.data.success;
                })
                .catch(function(error) {
                    existingObj.strSuccess ="";
                    existingObj.strError = error.response.data.message;
                });
            });
        }
    },
   
}
</script>