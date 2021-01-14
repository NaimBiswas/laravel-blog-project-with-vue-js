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
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Enter Your Category Name</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Sign in</button>
                  <button type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>

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
