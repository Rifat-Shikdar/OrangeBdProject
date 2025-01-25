<template>
    <div class="mt-5 container">
        <!-- <h1>Product create page</h1> -->

        <div class="card">
            <div class="card-header">
                <h4>Edit Product</h4>
                <NuxtLink to="/products" class="btn btn-danger float-end">Back</NuxtLink>
            </div>
            <div class="card-body">
                <!-- {{ this.errorList}} -->
                <div v-if="isLoading">
                    <Loading :title="isLoadingTitle" />
                </div>

                <div v-else>
                    <form @submit.prevent="updateProduct">

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
                            <button type="submit" class="btn btn-primary">Update</button>
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
    name: "productEdit",
    data() {
        return {
            productId:'',
            product: {},
            isLoading: false,
            isLoadingTitle: 'Loading',
            errorList: {}
        }

    },
    mounted(){

        this.productId = this.$route.params.id
        // alert(this.productId);

        this.getProduct(this.productId);

    },


    methods: {

        getProduct(productId){

            this.isLoading = true;

            axios.get(`http://127.0.0.1:8000/api/products/${productId}/edit`).then(res => {

                console.log(res);
                this.isLoading = false;
                this.product = res.data.product;
                

            });

        },

        updateProduct() {
            this.isLoading = true;
            //alert('am here');
            this.isLoadingTitle = "Updating";

            var myThis = this;


            axios.put(`http://localhost:8000/api/products/${this.productId}/edit`, this.product).then(res => {
                console.log(res, 'res');

                alert(res.data.message);

                this.product.name = '';
                this.product.price = '';
                this.isLoading = false;
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