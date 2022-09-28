<template>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">All prespections</h5>
            <div>
                <button class="btn btn-success" type="button" @click="this.$router.push('/perspections/add')">New  Prescription</button>
            </div>
            <div>
                    <router-link :to="{name: 'patients'}" class="btn btn-success">Go Back</router-link>
                </div>
    
        </div>
        
        <table class="table table-hover table-sm">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="50" class="text-center">Prescription</th>
                    <th>Medication</th>
                    <th>Starting date</th>
                    <th>Duration</th>
                    <th class="text-center" width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(perspection, index) in perspections" :key="perspection.id">
                    <td class="text-center">{{index+1}}.</td>
                    <td>{{perspection.medication}}</td>
                    <td>{{perspection.startingdate}}</td>
                    <td>{{perspection.duration}}</td>
                    <td class="text-center">
                        <router-link :to="{name:'editperspection', params: {id:perspection.id}}" class="btn btn-warning">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteperspection(perspection.id)">Delete</button>
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
                perspections: [],
                strSuccess: '',
                strError: ''
            }
        },
        created() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/perspections')
                .then(response => {
                    this.perspections = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
            });
        },
        methods: {
            deleteperspection(id) {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    let existingObj = this;
                    if(confirm("Do you really want to delete this data?")) {
                        this.$axios.delete(`/api/perspections/delete/${id}`)
                        .then(response => {
                            let i = this.perspections.map(item => item.id).indexOf(id); // find index of your object
                            this.perspections.splice(i, 1);
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