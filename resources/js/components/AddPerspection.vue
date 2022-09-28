<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Add New Prespection</h5>
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


            <form @submit.prevent="addPerspection" enctype="multipart/form-data">
             <div class="form-group mb-2">
                    <label>Medication</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="medication" placeholder="Enter medication">
                </div>

                <div class="form-group mb-2">
                    <label>Starting Date</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="startingdate" placeholder="Enter starting date of medication">
                </div>

                <div class="form-group mb-2">
                    <label>Duration</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="duration" placeholder="Enter  duration of taking the medication"></textarea>
                </div>
                

            

                <button type="submit" class="btn btn-primary mt-4 mb-4"> Add Prespection</button>

            </form>
            
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            medication:'',
            startingdate:'',
            duration:'',
            strSuccess: '',
            strError: '',
            
        }
    },
    methods: {
        
        addPerspection(e) {
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
                this.$axios.post('/api/perspections/add', formData, config)
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