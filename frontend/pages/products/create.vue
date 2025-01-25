<template>
    <div class="mt-5 container">
        <!-- <h1>Product create page</h1> -->

        <div class="card">

            <div class="card-header">
                <h4>Add Product</h4>
                <NuxtLink to="/products" class="btn btn-danger float-end">Back</NuxtLink>
            </div>
            <div class="card-body">
                <!-- {{ this.errorList}} -->
                <div v-if="isLoading">
                    <Loading :title="isLoadingTitle" />
                </div>

                <div v-else>
                    <form @submit.prevent="saveProduct">

                        <div class="mb-3">
                            <label> Name</label>
                            <input v-model="product.name" type="text" name="" id="" class="form-control" />
                            <span class="text-danger"></span>
                        </div>

                        <div class="mb-3">
                            <label> Price</label>
                            <input type="text" v-model="product.price" name="" id="" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
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
    name: "productCreate",
    data() {
        return {
            product: {
                name: '',
                price: ''
            },
            isLoading: false,
            isLoadingTitle: 'Loading',
            errorList: {}
        }

    },
    methods: {
        saveProduct() {
            this.isLoading = true;
            //alert('am here');
            this.isLoadingTitle = "Saving";

            var myThis = this;


            axios.post(`http://localhost:8000/api/products`, this.product).then(res => {
                console.log(res, 'res');

                alert(res.data.message);

                this.product.name = '';
                this.product.price = '';
                this.isLoading = false;
                this.$router.push('/products');
                this.isLoadingTitle = "Loading";
            })
            .catch(function (error){
                console.log(error, 'error');
                
                if(error.respose){
                    if(error.respose.status == 422){
                        myThis.errorList = error.respose.data.errors;
                        this.isLoading = false;
                    }
                }
            });
        }
    },

}
</script>

<style></style>