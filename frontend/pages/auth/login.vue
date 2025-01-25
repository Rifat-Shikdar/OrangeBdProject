<template>
    <div class="mt-5 container">
        <div class="card">
            <div class="card-header">
                <h4>Login</h4>
                <NuxtLink to="/auth/register" class="btn btn-primary float-end">Go to Register</NuxtLink>
            </div>
            <div class="card-body">
                <div v-if="isLoading">
                    <Loading :title="isLoadingTitle" />
                </div>
  
                <div v-else>
                    <form @submit.prevent="loginUser">
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
                            <button type="submit" class="btn btn-primary">Login</button>
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
    name: "Login",
    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            isLoading: false,
            isLoadingTitle: 'Loading',
            errorList: {}
        };
    },
    methods: {
        loginUser() {
            this.isLoading = true;
            this.isLoadingTitle = "Logging in";
  
            axios.post(`http://localhost:8000/api/login`, this.user)
                .then(res => {
                    alert(res.data.message);
                    localStorage.setItem('authToken', res.data.token);
  
                    this.user.email = '';
                    this.user.password = '';
                    this.$router.push('/products'); // Redirect to dashboard or another page
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        this.errorList = error.response.data.errors;
                    } else if (error.response && error.response.status === 401) {
                        alert('Invalid email or password.');
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
  