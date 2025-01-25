<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
            <div class="container">
                <NuxtLink class="navbar-brand" top="/">OrangeBd Project</NuxtLink>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <NuxtLink class="nav-link active" aria-current="page" to="/">Home</NuxtLink>
                        </li>
                        <li class="nav-item">
                            <NuxtLink class="nav-link" to="/about-us">About Us</NuxtLink>
                        </li>
                        <li class="nav-item">
                            <NuxtLink class="nav-link" to="/contact-us">Contact Us</NuxtLink>
                        </li>
                        <li class="nav-item">
                            <NuxtLink class="nav-link me-3 border border-info" to="/products">Product</NuxtLink>
                        </li>
                        <li class="nav-item  ms-auto mb-2 mb-lg-0 me-3">
                            <button class="btn btn-primary float-end">
                                <NuxtLink class="nav-link  text-light " to="/auth/register">Register</NuxtLink>
                            </button>
                        </li>
                        <li class="nav-item  ms-auto mb-2 mb-lg-0">
                            <button class="btn btn-primary float-end ">
                                <NuxtLink class="nav-link  text-light  " to="/auth/login">Login</NuxtLink>
                            </button>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>

    </div>

</template>

<script setup>
import { NuxtLink } from '#components';


</script>

<style></style>