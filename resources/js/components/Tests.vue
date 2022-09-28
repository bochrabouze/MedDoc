<template>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">All Tests and radiology</h5>
            <div>
                <button class="btn btn-success" type="button" @click="this.$router.push('/tests/add')">New Test</button>
            </div>
             <div>
                    <router-link :to="{name: 'patients'}" class="btn btn-success">Go Back</router-link>
                </div>
        </div>
        
        <table class="table table-hover table-sm">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="50" class="text-center">N°:</th>
                    <th class="text-center" width="120">Test or radiology</th>
                    <th class="text-center" width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(test, index) in tests" :key="test.id">
                    <td class="text-center">{{index+1}}.</td>
              
                  
                    <td class="text-center">
                        <div v-if="test.image">
                            <img alt="post-img" width="100" v-bind:src="'/img/' +test.image">
                        </div>
                    </td>
                    <td class="text-center">
                        
                        <button class="btn btn-danger" @click="deleteTest(test.id)">Delete</button>
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
                tests: [],
                strSuccess: '',
                strError: ''
            }
        },
        created() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/tests')
                .then(response => {
                    this.tests = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
            });
        },
        methods: {
            deleteTest(id) {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    let existingObj = this;
                    if(confirm("Do you really want to delete this data?")) {
                        this.$axios.delete(`/api/tests/delete/${id}`)
                        .then(response => {
                            let i = this.tests.map(item => item.id).indexOf(id); // find index of your object
                            this.tests.splice(i, 1);
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