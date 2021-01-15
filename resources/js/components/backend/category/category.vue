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
      <div class="card-header flex card-tools">
        <h5 class="text-uppercase" style="display: inline">Categoires</h5>
        <router-link
          to="/createcategory"
          class="text-uppercase btn btn-outline-danger btn-md float-right text-white"
          >Add Category</router-link
        >
      </div>
      <div class="card-body">
        <table class="table table-control table-bordered text-center">
          <tr>
            <td>ID.</td>
            <td>Name</td>
            <td>Status</td>
            <td>Action</td>
          </tr>

            <tr v-for="(category, index) in categories" :key="index">
              <td  >{{ category['id'] }}</td>
              <td class="h5">{{ category['name'] }}</td>
              <td>
                  <button v-if="category['status'] == 1" class="btn btn-outline-success btn-lg"><i class="fas fa-eye mr-2"></i>Active</button>
                  <button v-else class="btn btn-outline-warning btn-lg"><i class="fas fa-eye-slash mr-2"></i>Deactive</button>
              </td>
              <td>
                  <button class="btn btn-warning btn-lg mr-2" ><i class="fas fa-pen"></i></button>
                  <button class="btn btn-danger btn-lg mr-2" ><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>

        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "category",
  mounted() {
    this.$store.dispatch("getCategories");
  },
  computed: {
    categories() {
      return this.$store.getters.allCategory;
    },
  },
};
</script>

<style></style>
