<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Product Lists

                    <NuxtLink to="/products/create" class="btn btn-primary float-end ">Add Poduct</NuxtLink>
                    <NuxtLink to="/products/search" class=" me-3 btn btn-primary float-end">Search Product</NuxtLink>
                </h4>
            </div>
            <div class="card-body">

                <div v-if="isLoading">
                    <Loading title="Loading..." />
                </div>

                <div v-else>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in products" :key="index">
                                <td>{{ product.id }}</td>
                                <td>{{ product.name }}</td>
                                <td>{{ product.price }}</td>
                                <td>{{ product.created_at }}</td>

                                <td>
                                    <NuxtLink :to="`/products/${product.id}`" class="btn btn-success btn-sm mx-2">Edit
                                    </NuxtLink>
                                    <button type="button" @click="deleteProduct($event, product.id)"
                                        class="btn btn-danger btn-sm mx-2">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    name: "product",
    data() {
        return {
            products: {},
            isLoading: true,
        }
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        getProducts() {

            this.isLoading = true;

            axios.get(`http://127.0.0.1:8000/api/products`).then(res => {
                console.log(res);
                this.isLoading = false;
                this.products = res.data.prodcuts
                    ;
            });
        },
        deleteProduct(event, productId){

            if(confirm('Are You Sure, you want to delete?')){

                event.target.innerText = 'Deleting';
                axios.delete(`http://127.0.0.1:8000/api/products/${productId}/delete`).then(res => {

                    event.target.innerText = 'Deleted';
                    this.getProducts();

                });

            }

        }
    }
}
</script>

<style></style>