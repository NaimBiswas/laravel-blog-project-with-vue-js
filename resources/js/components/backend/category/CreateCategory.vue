<template>
    <div class="">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a>Category</a>
                            </li>
                            <li class="breadcrumb-item active"><span >Create Category</span></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <div class="card">
            <div class="card-header flex card-tools ">
                <h5 class="text-uppercase" style="display:inline">Add Category</h5>
                <router-link to="/category" class="text-uppercase btn btn-info btn-md float-right text-white">Go Back</router-link>
            </div>
            <div class="card-body">

                 <h2>Hi i am Create category</h2>
            </div>
        </div>
    </div>
</template>

<script>
import Button from '../../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Button.vue';
export default {
    name: "category"
};
        Button
</script>

<style></style>
