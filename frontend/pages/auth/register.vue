<template>
    <div class="mt-5 container">
        <div class="card">
            <div class="card-header">
                <h4>Register</h4>
                <NuxtLink to="/auth/login" class="btn btn-primary float-end">Go to Login</NuxtLink>
            </div>
            <div class="card-body">
                <div v-if="isLoading">
                    <Loading :title="isLoadingTitle" />
                </div>
  
                <div v-else>
                    <form @submit.prevent="registerUser">
                        <div class="mb-3">
                            <label>Name</label>
                            <input v-model="user.name" type="text" class="form-control" />
                            <span class="text-danger" v-if="errorList.name">{{ errorList.name[0] }}</span>
                        </div>
  
                        <div class="mb-3">
                            <label>Email</label>
                            <input v-model="user.email" type="email" class="form-control" />
                            <span class="text-danger" v-if="errorList.email">{{ errorList.email[0] }}</span>
                        </div>
  
                        <div class="mb-3">
                            <label>Password</label>
                            <input v-model="user.password" type="password" class="form-control" />
                            <span class="text-danger" v-if="errorList.password">{{ errorList.password[0] }}</span>
                        </div>
  
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    name: "Register",
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: ''
            },
            isLoading: false,
            isLoadingTitle: 'Loading',
            errorList: {}
        };
    },
    methods: {
        registerUser() {
            this.isLoading = true;
            this.isLoadingTitle = "Registering";
  
            axios.post(`http://localhost:8000/api/register`, this.user)
                .then(res => {
                    alert(res.data.message);
                    localStorage.setItem('authToken', res.data.token);
  
                    this.user.name = '';
                    this.user.email = '';
                    this.user.password = '';
                    this.$router.push('/auth/login');
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        this.errorList = error.response.data.errors;
                    }
                })
                .finally(() => {
                    this.isLoading = false;
                });
        }
    }
  };
  </script>
  
  <style></style>