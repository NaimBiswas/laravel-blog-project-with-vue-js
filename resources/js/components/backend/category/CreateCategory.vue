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
              <li class="breadcrumb-item active">
                <span>Create Category</span>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <div class="card">
      <div class="card-header flex card-tools">
        <h5 class="text-uppercase" style="display: inline">Add Category</h5>
        <router-link
          to="/category"
          class="text-uppercase btn btn-outline-info btn-md float-right text-white"
          >Go Back</router-link
        >
      </div>
      <div class="card-body">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title pt-2">Enter Your Category Name</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form @submit.prevent="addCategory" class="form-horizontal">
            <div class="card-body">
              <div class="form-group row">
                <label for="catname" class="col-sm-2 col-form-label"
                  >Category Name:</label
                >
                <div class="col-sm-10">
                  <input
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    id="catname"
                    placeholder="Enter Your Category Name"
                    name="name"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                  />
                  <has-error :form="form" field="name"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="catname" class="col-sm-2 col-form-label"
                  >Status:</label
                >
                <div class="col-sm-10 flex">
                  <a
                    v-if="form.status"
                    @click="deactive"
                    class="btn btn-success btn-md"
                    >Active</a
                  >
                  <a v-else @click="active" class="btn btn-warning btn-md"
                    >Deactive</a
                  >
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button
                type="submit"
                class="btn btn-outline-success btn-md text-uppercase"
              >
                AdD Category
              </button>
              <button type="reset" class="btn btn-default float-right">
                Cancel
              </button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "category",

  data() {
    return {
      form: new Form({
        name: "",
        status: false,
      }),
    };
  },
  methods: {
    active() {
      this.form.status = true;
    },
    deactive() {
      this.form.status = false;
    },
    addCategory() {
      this.form.post("/savecategory");
      this.form.name = '';
      this.form.status = false;
    },
  },
};
</script>

<style>
.form-control:focus {
  color: #fdfeff;
  background-color: #394046;
  border-color: #a1cbef;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
}
</style>
