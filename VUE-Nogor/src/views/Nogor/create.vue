<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Add Data</h4>
            </div>
            <div class="card-body">
                <!-- <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0 && saveData">
                    <li class="mb-0 ms-3" v-for="(error,index) in this.errorList" :key="index">
                        {{error}}
                    </li>
                </ul> -->
                <form id="input" enctype="multipart/form-data">
                <div class="mb-3">
                    <label >Name</label>
                    <input type="text" name="name" @keyup="validate()" v-model="model.dataNogor.name" class="form-controll" />
                    <p class="text-danger" v-if="errorList.name">{{ errorList.name }}</p>
                </div>
                <div class="mb-3">
                    <label >Email</label>
                    <input type="text" name="email" @keyup="validate()" v-model="model.dataNogor.email" class="form-controll" />
                    <p class="text-danger" v-if="errorList.email">{{ errorList.email }}</p>
                </div>
                <div class="mb-3">
                    <label >Image</label>
                    <input type="file" ref="fileInput" @change="validateImage()" name="image" class="form-controll" />
                    <p class="text-success" v-if="success">{{success}}</p>
                    <p class="text-danger" v-for="(error,i) in errors" :key="i">{{error}}</p>
                </div>
                <div class="mb-3">
                    <label >Gender</label>
                    <p class="text-danger" v-if="errorList.gender">{{ errorList.gender }}</p>
                    <div class="form-check">
                    <input class="form-check-input" @change="validate()" v-model="model.dataNogor.gender" type="radio" name="gender" value="male" id="flexRadioDefault1" >
                    <label class="form-check-label" for="flexRadioDefault1">
                        Male
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" @change="validate()" v-model="model.dataNogor.gender" type="radio" name="gender" value="female" id="flexRadioDefault2" >
                    <label class="form-check-label" for="flexRadioDefault2">
                        Female
                    </label>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Skills</label>
                    <p class="text-danger" v-if="errorList.skills">{{ errorList.skills }}</p>
                    <div class="form-check" v-for="(a,i) in options" :key="i">
                        <input class="form-check-input" @change="checkboxValidate()" v-model="a.item" text-field="name" type="checkbox" id="flexCheckDefault" >
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ a.name }}
                        </label>
                    </div>
                    
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" @click.prevent="saveData" type="button">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster({ /* options */ });
    export default {
        name: "nogorCreate",
        data(){
            return{
                checkBox: false,
                errors: [],
                success: null,
                errorList : {},
                options: [
                    { item: false, name: 'Laravel' },
                    { item: false, name: 'Ajax' },
                    { item: false, name: 'Vue JS' },
                    { item: false, name: 'MySQL' }
                ],
                model:{
                    dataNogor:{
                        name:'',
                        email:'',
                        image:'',
                        gender:'',
                        skills:'',
                    }
                }
            }
        },
        methods:{
            checkboxValidate(){
                let x=0;
                this.checkBox=false;
                for(let i=0; i<this.options.length; i++){
                    if(this.options[i].item ==true){
                        x++;
                        this.errorList.skills='';
                    }
                    // else{
                    //     this.errorList.skills = 'skills are required';
                    // }
                }
                if(x==0){
                    this.errorList.skills = 'skills are required';
                    this.checkBox = true;
                }
            },
            validate(){
                for (const property in this.model.dataNogor) {
                    console.log(`${property}: ${this.model.dataNogor[property]}`);
                    if(this.model.dataNogor[property]==''){
                        this.errorList[property] = property + " is required";
                    }
                    else{
                        this.errorList[property] ='';
                    }
                }
            },

            saveData(){
                if (this.errors.length>0) {
                    return false;  ////////Image validation save stop
                }
                if(this.checkBox==true){
                    return false; /////////Checkbox validation save stop
                }
                //this.validate();
                //console.log(Object.keys(this.errorList));
                // if(Object.keys(this.errorList).length>0){
                //     return false;
                // }
                let mythis = this;
                const form=document.getElementById('input');
                let formData = new FormData(form);
                formData.append('skills', JSON.stringify(this.options));
                //console.log('hit');
                axios.post('http://127.0.0.1:8000/api/form',formData)
                    .then(res=>{
                        if(res.data.status==202){
                            for (const property in res.data.error) {
                                 this.errorList[property] = res.data.error[property][0];
                            }
                        }
                        if (res.data.status==200) {
                            toaster.success(`Data Stored Successfully`,{position:"top",diration:5000});
                        }
                        //alert(res.data.message)
                        this.model.dataNogor={
                            name:'',
                            email:'',
                            image:'',
                            gender:'',
                            skills:'',
                        }
                    }).catch(function (error) {
                    if (error.response) {
                        if (error.response.status == 202){
                            mythis.errorList = error.response.data.errors;
                        }
                        /*console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);*/
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                })
            },
            validateImage() {
                let file = this.$refs.fileInput.files[0];
                let allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                this.errors = [];

                if (!file) {
                    this.errors.push('Please select an image file');
                    return;
                }

                if (!allowedTypes.includes(file.type)) {
                    this.errors.push('Invalid file type. Only jpeg, png, and gif are allowed.');
                }

                if (file.size > 500000) {
                    this.errors.push('File size too large. Maximum size is 500KB.');
                }

                let image = new Image();
                let reader = new FileReader();

                reader.onload = (e) => {
                    image.src = e.target.result;

                    image.onload = () => {
                        if (image.width < 100 || image.height < 100) {
                            this.errors.push('Image resolution too low. Minimum size is 100x100.');
                        }

                        if (this.errors.length === 0) {
                            this.success = 'Image validated successfully'
                        }
                    };
                };

                reader.readAsDataURL(file);
            },
        },
    }
</script>

<style scoped>

</style>