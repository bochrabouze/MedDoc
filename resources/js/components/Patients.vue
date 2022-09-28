<template>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">All Patients Data</h5>
            <div>
                <button class="btn btn-success" type="button" @click="this.$router.push('/patients/add')">New Patient</button>
            </div>
        </div>
        
        <table class="table table-hover table-sm">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="50" class="text-center">Patient</th>
                    <th>First Name</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Date of birth</th>
                    <th>Blood Group</th>
                    <th>Weigh</th>
                    <th>Height</th>
                    <th>Allergy</th>
                    <th>Chronic disease</th>
                     <th class="text-center" width="200">Patient's medical record</th>
                     <th class="text-center" width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(patient, index) in patients" :key="patient.id">
                    <td class="text-center">{{index+1}}.</td>
                    <td>{{patient.firstname}}</td>
                    <td>{{patient.name}}</td>
                    <td>{{patient.address}}</td>
                    <td>{{patient.phone}}</td>
                    <td>{{patient.dateofbirth}}</td>
                    <td>{{patient.bloodgroup}}</td>
                    <td>{{patient.weigh}}</td>
                    <td>{{patient.height}}</td>
                    <td>{{patient.allergy}}</td>
                    <td>{{patient.chronicdisease}}</td>
                    <td class="text-center">
                    <button   button class="btn btn-success" type="button" @click="this.$router.push('/visits')">Medical Visits</button>
                    <button class="btn btn-success" type="button" @click="this.$router.push('/perspections')">Prespections</button>
                    <button class="btn btn-success" type="button" @click="this.$router.push('/tests')">Tests and radiology</button>
                      </td>
                     <td class="text-center">
                        <router-link :to="{name:'editpatient', params: {id:patient.id}}" class="btn btn-warning">Edit</router-link>
                        <button class="btn btn-danger" @click="deletePatient(patient.id)">Delete</button>
                       </td>
         
                  
                </tr>
            </tbody>
        </table>


    </div>
</div>


</template>

<script>
    export default {
        data() {
            return {
                patients: [],
                strSuccess: '',
                strError: ''
            }
        },
        created() {
           
    if (window.Laravel.user) {
            this.name = window.Laravel.user.name
        }
        
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/patients')
                .then(response => {
                    this.patients = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
            });
        },
        methods: {
            deletePatient(id) {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    let existingObj = this;
                    if(confirm("Do you really want to delete this data?")) {
                        this.$axios.delete(`/api/patients/delete/${id}`)
                        .then(response => {
                            let i = this.patients.map(item => item.id).indexOf(id); // find index of your object
                            this.patients.splice(i, 1);
                            existingObj.strError = "";
                            existingObj.strSuccess = response.data.success;
                        })
                        .catch(function(error) {
                            existingObj.strError = "";
                            existingObj.strSuccess = error.response.data.message;
                        });
                    }
                });
            }
        },
       
    
       
    }
</script>