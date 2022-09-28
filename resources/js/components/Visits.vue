<template>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">All Medical Visits</h5>
            <div>
                <button class="btn btn-success" type="button" @click="this.$router.push('/visits/add')">New Medical Visit</button>
            </div>
            <div>
                    <router-link :to="{name: 'patients'}" class="btn btn-success">Go Back</router-link>
                </div>
        </div>
        
        <table class="table table-hover table-sm">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="50" class="text-center">Medical Visit</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Diagnostic</th>
                    <th>Synthesis</th>
                    <th>Tests requested</th>
                    <th class="text-center" width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(visit, index) in visits" :key="visit.id">
                    <td class="text-center">{{index+1}}.</td>
                    <td>{{visit.date}}</td>
                    <td>{{visit.time}}</td>
                    <td>{{visit.diagnostic}}</td>
                    <td>{{visit.synthesis}}</td>
                    <td>{{visit.tests}}</td>
                    <td class="text-center">
                        <router-link :to="{name:'editvisit', params: {id:visit.id}}" class="btn btn-warning">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteVisit(visit.id)">Delete</button>
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
                visits: [],
                strSuccess: '',
                strError: ''
            }
        },
        created() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/visits')
                .then(response => {
                    this.visits = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
            });
        },
        methods: {
            deleteVisit(id) {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    let existingObj = this;
                    if(confirm("Do you really want to delete this data?")) {
                        this.$axios.delete(`/api/visits/delete/${id}`)
                        .then(response => {
                            let i = this.visits.map(item => item.id).indexOf(id); // find index of your object
                            this.visits.splice(i, 1);
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