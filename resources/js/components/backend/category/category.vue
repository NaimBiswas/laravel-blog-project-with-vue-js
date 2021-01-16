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
            <td>Created At</td>
          </tr>

          <tr v-for="(category, index) in categories" :key="index">
            <td>{{ index + 1 }}</td>
            <td class="h5">{{ category["name"] }}</td>
            <td>
              <button
                v-if="category['status'] == 1"
                class="btn btn-outline-success btn-lg"
              >
                <i class="fas fa-eye mr-2"></i>Active
              </button>
              <button v-else class="btn btn-outline-warning btn-lg">
                <i class="fas fa-eye-slash mr-2"></i>Deactive
              </button>
            </td>
            <td>
              <button class="btn btn-warning btn-lg mr-2">
                <i class="fas fa-pen"></i>
              </button>
              <button
                @click="removeCategory(category['id'])"
                class="btn btn-danger btn-lg mr-2"
              >
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
            <td>{{ category["created_at"] }}</td>
          </tr>
          <tr v-if="isShowing()">
            <td class="text-center text-uppercase text-danger h4" colspan="5">
              No category Found!
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
  methods: {
    removeCategory(id) {
      swalWithBootstrapButtons
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
              axios
                 .delete("remove-category/" + id)
                 .then((response) => {
                   toastr.success('category Deleted Success');
                 });
                swalWithBootstrapButtons.fire(
                    "Deleted!",
                "Category Has Been Deleted.",
                "success"
                );
                this.$store.dispatch("getCategories");
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              "Cancelled",
              "Your imaginary file is safe :)",
              "error"
            );
          }
        });
    //   axios
    //     .delete("remove-category/" + id)
    //     .then((response) => {
    //       Toast.fire({
    //         icon: "success",
    //         title: "Category Deleted Success",
    //       });
    //       this.$store.dispatch("getCategories");
    //     })
    //     .catch((error) => {
    //       Toast.fire({
    //         icon: "warning",
    //         title: error,
    //       });
    //     });
    },

    isShowing() {
      return this.categories.length < 1;
    },
  },
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

<style>
button.swal2-confirm.btn.btn-success {
    margin-left: 10px;

    font-size: 20px;
}
button.swal2-cancel.btn.btn-danger{
    font-size: 20px;
}
.swal2-container.swal2-backdrop-show, .swal2-container.swal2-noanimation {
    background: rgb(0 71 202 / 38%);
}
.dark-mode .swal2-popup {
    background-color: #343a40e6;
    color: #e9ecef;
    padding-bottom: 40px;
}
</style>
