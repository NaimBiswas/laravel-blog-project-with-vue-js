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
            <td>
              <div class="icheck-success d-inline">
                <input
                  :disabled="isShowing()"
                  @click="selectTotall"
                  v-model="selectAll"
                  type="checkbox"
                  id="checkboxSuccess1"
                />
              </div>
            </td>
            <td>ID.</td>
            <td>Name</td>
            <td>Status</td>
            <td>Action</td>
            <td>Created At</td>
          </tr>

          <tr v-for="(category, index) in categories" :key="index">
            <td class="">
              <input
                v-model="select"
                type="checkbox"
                :value="category.id"
                id="checkboxSuccess1"
              />
            </td>
            <td>{{ index + 1 }}</td>
            <td class="h5">{{ category["name"] }}</td>
            <td>
              <button
                @click="deactiveOne(category['id'])"
                v-if="category['status'] == 1"
                class="btn btn-outline-success btn-lg"
              >
                <i class="fas fa-eye mr-2"></i>Active
              </button>
              <button @click="activeOne(category.id)" v-else class="btn btn-outline-warning btn-lg">
                <i class="fas fa-eye-slash mr-2"></i>Deactive
              </button>
            </td>
            <td>
              <router-link
                :to="`/editecategory/${category.slug}`"
                class="btn btn-outline-warning btn-lg mr-2"
              >
                <i class="fas fa-pen"></i>
              </router-link>
              <button
                @click="removeCategory(category['id'])"
                class="btn btn-outline-danger btn-lg mr-2"
              >
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
            <td>{{ category["created_at"] }}</td>
          </tr>
          <tr v-if="isShowing()">
            <td class="text-center text-uppercase text-danger h4" colspan="6">
              No category Found!
            </td>
          </tr>
          <tr v-if="isSelected">
            <td class="text-left text-uppercase text-danger h4" colspan="6">
              <button
                @click="activeAll(select)"
                :disabled="!isSelected"
                class="btn btn-outline-success btn-lg"
              >
                <i class="fas fa-eye"></i>
              </button>

              <button
                @click="deActiveAll(select)"
                :disabled="!isSelected"
                class="btn btn-outline-warning btn-lg"
              >
                <i class="fas fa-eye-slash"></i>
              </button>

              <button
                @click="deleteAll(select)"
                :disabled="!isSelected"
                class="btn btn-outline-danger btn-lg"
              >
                <i class="fas fa-trash"></i>
              </button>
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
  data() {
    return {
      select: [],
      isSelected: false,
      selectAll: false,
    };
  },
  methods: {
      deactiveOne(id){
           axios
        .post("/deactive-category/" + id)
        .then((response) => {
          toastr.success("Categoires Deactive success");
          this.$store.dispatch("getCategories");
        })
        .catch((error) => {
          toastr.warning(error);
        });
      },
    activeOne(id) {
      axios
        .post("/active-category", { data: id })
        .then((response) => {
          toastr.success("Categoires Active success");
          this.$store.dispatch("getCategories");
        })
        .catch((error) => {
          toastr.warning(error);
        });
    },
    deActiveAll(select) {
      axios
        .post("/deactive-categories", { data: select })
        .then((response) => {
          toastr.success(response.data.total + ' ' + "Categoires Deactive success");
          this.$store.dispatch('getCategories');
           this.select= [];
          this.isSelecte= false;
          this.selectAll= false;
        })
        .catch((error) => {
          toastr.warning(error);
        });
    },
    activeAll(select) {
      axios
        .post("/active-categories", { data: select })
        .then((response) => {
          toastr.success(response.data.total + ' ' + "Categoires active success");
          this.$store.dispatch("getCategories");
           this.select= [];
          this.isSelecte= false;
          this.selectAll= false;
        })
        .catch((error) => {
          toastr.warning(error);
        });
    },
    deleteAll(select) {
      axios
        .post("/delete-categories", { data: select })
        .then((response) => {
          toastr.info(response.data.total + ' ' + "Category Has Been Successfully Deleted ");
          this.$store.dispatch("getCategories");
           this.$store.dispatch("getCategories");
          this.select= [];
          this.isSelecte= false;
          this.selectAll= false;
        })
        .catch((error) => {
          toastr.warning(error);
        });
    },
    selectTotall(event) {
      if (event.target.checked == false) {
        this.select = [];
      } else {
        this.categories.forEach((category) => {
          this.select.push(category.id);
        });
      }
    },

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
            axios.delete("remove-category/" + id).then((response) => {
              toastr.success("category Deleted Success");
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
              "Thank You For Change Your decession :)",
              "error"
            );
          }
        });
    },

    isShowing() {
      return this.categories.length < 1;
    },
    seletedCategoryLength() {
      return this.select.length;
    },
    allCategoryLength() {
      return this.categories.length;
    },
  },
  mounted() {
    this.$store.dispatch("getCategories");
  },
  watch: {
    select(select) {
      this.isSelected = select.length > 0;
      this.selectAll = select.length == this.categories.length;
    },
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
button.swal2-cancel.btn.btn-danger {
  font-size: 20px;
}
.swal2-container.swal2-noanimation {
  background: rgb(0 71 202 / 38%);
}
.dark-mode .swal2-popup {
  background-color: #343a40e6;
  color: #e9ecef;
  padding-bottom: 40px;
}
#checkboxSuccess1 {
  height: 22px;
  width: 25px;
}
</style>
