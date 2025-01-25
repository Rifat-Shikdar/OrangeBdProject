<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Search Product by ID</h4>
            </div>
            <div class="card-body">
               
                <div class="mb-3">
                    <input type="text" v-model="searchId" placeholder="Enter Product ID" class="form-control" />
                    <button @click="searchProductById" class="btn btn-info mt-2">Search</button>
                </div>

                <div v-if="isLoading">
                    <Loading title="Loading..." />
                </div>

                <div v-else>
                    <div v-if="product">
                        <h5>Product Details</h5>
                        <p><strong>ID:</strong> {{ product.id }}</p>
                        <p><strong>Name:</strong> {{ product.name }}</p>
                        <p><strong>Price:</strong> {{ product.price }}</p>
                        <p><strong>Created At:</strong> {{ product.created_at }}</p>
                    </div>
                    <div v-else>
                        <p>No product found with the given ID.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "ProductSearch",
    data() {
        return {
            searchId: '', 
            product: null, 
            isLoading: false,
        };
    },
    methods: {
        searchProductById() {
            if (this.searchId) {
                this.isLoading = true;
                axios.get(`http://127.0.0.1:8000/api/products/${this.searchId}`).then(res => {
                    this.isLoading = false;
                    this.product = res.data.product; 
                }).catch(error => {
                    this.isLoading = false;
                    this.product = null; 
                    alert('Product not found!');
                });
            } else {
                alert('Please enter a product ID!');
            }
        }
    }
};
</script>

<style>

</style>
