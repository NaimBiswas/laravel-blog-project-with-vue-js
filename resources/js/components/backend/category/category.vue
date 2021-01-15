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
                                <router-link to="/category" href="#">Category</router-link>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <div class="card">
            <div class="card-header flex card-tools ">
                <h5 class="text-uppercase" style="display:inline">Categoires</h5>
                <router-link to="/createcategory" class="text-uppercase btn btn-outline-danger btn-md float-right text-white">Add Category</router-link>
            </div>
            <div class="card-body">

                 <h2>Hi i am category {{ hop }}</h2>

            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "category",
    computed:{
        hop(){
            this.$store.state.data;
        },

    },

};

</script>

<style></style>
