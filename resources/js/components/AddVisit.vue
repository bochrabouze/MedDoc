<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Add New visit Medical Visit</h5>
                <div>
                    <router-link :to="{name: 'visits'}" class="btn btn-success">Go Back</router-link>
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


            <form @submit.prevent="addVisit" enctype="multipart/form-data">
             <div class="form-group mb-2">
                    <label>Date</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="date" placeholder="Enter the date of the medical visit">
                </div>

                <div class="form-group mb-2">
                    <label>Time</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="time" placeholder="Enter the time of the medical visit">
                </div>

                <div class="form-group mb-2">
                    <label>Diagnostic</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="diagnostic" placeholder="Enter your diagnostic"></textarea>
                </div>
                 <div class="form-group mb-2">
                    <label>Synthesis</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="synthesis" placeholder="Enter your synthesis"></textarea>
                </div>
                 <div class="form-group mb-2">
                    <label>Tests and radiology requested for the next  medical visit</label>
                   <textarea class="form-control" rows="3" v-model="tests" placeholder="Enter the tests and radiology "></textarea>
                </div>
                

                <button type="submit" class="btn btn-primary mt-4 mb-4"> Add visit</button>

            </form>
            
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            date:'',
            time:'',
            diagnostic:'',
            synthesis:'',
            tests:'',
            strSuccess: '',
            strError: '',
            
        }
    },
    methods: {
       
        addVisit(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                const formData = new FormData();
                formData.append('date', this.date);
                formData.append('time', this.time);
                formData.append('diagnostic', this.diagnostic);
                formData.append('synthesis', this.synthesis);
                formData.append('tests', this.tests);
                this.$axios.post('/api/visits/add', formData, config)
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