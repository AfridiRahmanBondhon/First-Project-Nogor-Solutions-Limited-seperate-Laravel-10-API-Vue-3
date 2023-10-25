<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>
                    Students
                    <RouterLink to="/nogor/create" class="btn btn-primary float-end">Add Student</RouterLink>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Gender</th>
                        <th>Skills</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody v-if="this.dataNogor.length > 0">
                    <tr v-for="(dataNogor,index) in this.dataNogor" :key="index">
                        <td>{{dataNogor.id}}</td>
                        <td>{{dataNogor.name}}</td>
                        <td>{{dataNogor.email}}</td>
                        <td><img :src="dataNogor.image" alt="error" style="height: 150px;width: 150px"></td>
                        <td>{{dataNogor.gender}}</td>
                        <td>{{dataNogor.skills}}</td>
                        <td>
                            <RouterLink :to="{path: '/nogor/'+dataNogor.id+'/edit'}" class="btn btn-primary">Edit</RouterLink>
                            <button type="button" @click="deleteData(dataNogor.id)" class="btn btn-danger">Delete</button>
                            <button type="button" @click="softDeleteData(dataNogor.id)" class="btn btn-success">Soft Delete</button>
                        </td>
                    </tr>
                    </tbody>
                    <tbody v-else>
                    <tr>
                        <td colspan="5">Loading..</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({ /* options */ });
    export default {
        name: "nogorView",
        data(){
            return{
                dataNogor:[]
            }
        },
        mounted() {
            this.getDataNogor();
            // console.log('i am here')
        },
        methods:{
            getDataNogor(){
                axios.get(`http://127.0.0.1:8000/api/form`).then(res=>{
                    this.dataNogor = res.data.forms
                    console.log(this.dataNogor)
                    console.log(res)
                });
            },
            deleteData(dataId){
                if (confirm('Are you sure you want to delete data?')){
                    console.log(dataId)
                    axios.delete(`http://127.0.0.1:8000/api/form/${dataId}/delete`)
                        .then(res => {
                            if (res.data.status==200) {
                                toaster.warning(`Data Deleted Successfully`,{position:"top",diration:5000});
                            }
                            //alert(res.data.message)
                            this.getDataNogor()
                        }).catch(function (error) {
                        if (error.response) {
                            if (error.response.status == 404){
                                alert(error.response.data.message);
                            }
                        }
                    });
                }
            },
            softDeleteData(dataId){
                if (confirm('Are you sure you want to delete data?')){
                    //console.log(dataId)
                    axios.delete(`http://127.0.0.1:8000/api/form/${dataId}/softdelete`)
                        .then(res => {
                            if (res.data.status==200) {
                                toaster.warning(`Data Deleted Successfully`,{position:"top",diration:5000});
                            }
                            //alert(res.data.message)
                            this.getDataNogor()
                        }).catch(function (error) {
                        if (error.response) {
                            if (error.response.status == 404){
                                alert(error.response.data.message);
                            }
                        }
                    });
                }
            },
        },
    }
</script>

<style scoped>

</style>