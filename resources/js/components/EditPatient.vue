<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Update Patient Data</h5>
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


            <form @submit.prevent="updatePatient" enctype="multipart/form-data">
               <div class="form-group mb-2">
                    <label>First Name</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="firstname" placeholder="Enter patient first name">
                </div>

                <div class="form-group mb-2">
                    <label>Name</label><span class="text-danger"> *</span>
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
                   <textarea class="form-control" rows="3" v-model="dateofbirth" placeholder="Enter patient date of birth"></textarea>
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
                    <label>Heigh</label><span class="text-danger"> </span>
                   <textarea class="form-control" rows="3" v-model="height" placeholder="Enter patient heigh"></textarea>
                </div>
                  <div class="form-group mb-2">
                    <label>Allergy</label><span class="text-danger"> </span>
                   <textarea class="form-control" rows="3" v-model="allergy" placeholder="Enter patient allergy"></textarea>
                </div>
                  <div class="form-group mb-2">
                    <label>Chronic Disease</label><span class="text-danger"> </span>
                   <textarea class="form-control" rows="3" v-model="chronicdisease" placeholder="Enter patient chronic disease"></textarea>
                </div>
                

                <button type="submit" class="btn btn-primary mt-4 mb-4"> Update Patient</button>

            </form>
            
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            id:'',
            firstname: '',
            name:'',
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
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/patients/edit/${this.$route.params.id}`)
            .then(response => {
                this.firstname = response.data['firstname'];
                this.name = response.data['name'];
                this.address = response.data['address'];
                this.phone = response.data['phone'];
                this.dateofbirth = response.data['dateofbirth'];
                this.bloodgroup = response.data['bloodgroup'];
                this.weigh = response.data['weigh'];
                this.height = response.data['height'];
                this.allergy = response.data['allergy'];
                this.chronicdisease = response.data['chronicdisease'];
               
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
                formData.append('firstname', this.firstname);
                formData.append('name', this.name);
                formData.append('phone', this.phone);
                formData.append('address', this.address);
                formData.append('dateofbirth', this.dateofbirth);
                formData.append('bloodgroup', this.bloodgroup);
                formData.append('weigh', this.weigh);
                formData.append('height', this.height);
                formData.append('allergy', this.allergy);
                formData.append('chronicdisease', this.chronicdisease);
                this.$axios.post(`/api/patients/update/${this.$route.params.id}`, formData, config)
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