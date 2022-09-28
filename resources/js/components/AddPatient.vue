<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Add New Patient Data</h5>
                <div>
                    <router-link :to="{name: 'patients'}" class="btn btn-success">Go Back</router-link>
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


            <form @submit.prevent="addPatient" enctype="multipart/form-data">
             <div class="form-group mb-2">
                    <label>First Name</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="firstname" placeholder="Enter patient first name">
                </div>

                <div class="form-group mb-2">
                    <label>Second Name</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="name" placeholder="Enter patient name">
                </div>

                <div class="form-group mb-2">
                    <label>Address</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="address" placeholder="Enter patient address"></textarea>
                </div>
                 <div class="form-group mb-2">
                    <label>Phone number</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="phone" placeholder="Enter patient phone number"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label>Date of birth</label><span class="text-danger"> *</span>
                    <input type="date" class="form-control" v-model="dateofbirth" placeholder="Enter patient date of birth">
                </div>
                 <div class="form-group mb-2">
                    <label>Blood Group</label><span class="text-danger"> </span>
                   <textarea class="form-control" rows="3" v-model="bloodgroup" placeholder="Enter patient Blood Group"></textarea>
                </div>
                 <div class="form-group mb-2">
                    <label>Weigh</label><span class="text-danger"> </span>
                   <textarea class="form-control" rows="3" v-model="weigh" placeholder="Enter patient weigh"></textarea>
                </div>
                 <div class="form-group mb-2">
                    <label>Height</label><span class="text-danger"> </span>
                   <textarea class="form-control" rows="3" v-model="height" placeholder="Enter patient height"></textarea>
                </div>
                  <div class="form-group mb-2">
                    <label>Allergy</label><span class="text-danger"> </span>
                   <textarea class="form-control" rows="3" v-model="allergy" placeholder="Enter patient allergy"></textarea>
                </div>
                  <div class="form-group mb-2">
                    <label>Chronic Disease</label><span class="text-danger"> </span>
                   <textarea class="form-control" rows="3" v-model="chronicdisease" placeholder="Enter patient chronic disease"></textarea>
                </div>

            

                <button type="submit" class="btn btn-primary mt-4 mb-4"> Add Patient</button>

            </form>
            
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            firstname: '',
            name: '',
            address: '',
            phone:'',
            dateofbirth:'',
            bloodgroup: '',
            weigh: '',
            height:'',
            allergy:'',
            chronicdisease:'',
            
            strSuccess: '',
            strError: '',
            
        }
    },
    methods: {
        
        addPatient(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                const formData = new FormData();
                formData.append('firstname', this.firstname);
                formData.append('name', this.name);
                formData.append('address', this.address);
                formData.append('phone', this.phone);
                formData.append('dateofbirth', this.dateofbirth);
                formData.append('bloodgroup', this.bloodgroup);
                formData.append('weigh', this.weigh);
                formData.append('height', this.height);
                formData.append('allergy', this.allergy);
                formData.append('chronicdisease', this.chronicdisease);
                this.$axios.post('/api/patients/add', formData, config)
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