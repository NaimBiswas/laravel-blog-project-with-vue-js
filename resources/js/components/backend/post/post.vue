<template>
  <div class="">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Posts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/post" href="#">Posts</router-link>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <div class="card">
      <div class="card-header flex card-tools">
        <h5 class="text-uppercase" style="display: inline">Posts</h5>
        <router-link
          to="/create-post"
          class="text-uppercase btn btn-outline-danger btn-md float-right text-white"
          >Add New Post</router-link
        >
      </div>
      <div class="card-body">
        <table class="table table-control table-bordered text-center">
          <tr>
            <td :disable="isShowing">
              <div class="icheck-success d-inline">
                <input
                  @click="SelectAllPost"
                  v-model="SelectAll"
                  type="checkbox"
                  id="checkboxSuccess1"
                />
                <label for="checkboxSuccess1"> </label>
              </div>
            </td>
            <td>ID.</td>
            <td>Title</td>
            <td>Category</td>
            <td>Image</td>
            <td>Status</td>
            <td style="width: 148px">Action</td>
            <td>Post Creator</td>
          </tr>

          <tr v-for="(post, index) in posts" :key="index">
            <td class="">
              <input
                type="checkbox"
                v-model="postIDS"
                :value="post.id"
                id="checkboxSuccess1"
              />
            </td>
            <td>{{ index + 1 }}</td>
            <td class="h5">{{ post["title"] }}</td>
            <td class="h5">{{ post["category"]["name"] }}</td>
            <td class="h5">
                <img style="cursor:pointer" class=" img-fluid max-width: 100%" :src="post.images" alt="">
            </td>
            <td>
              <button
                v-if="post['status'] == 1"
                class="btn btn-outline-success btn-lg"
              >
                <i class="fas fa-eye mr-2"></i>Active
              </button>
              <button v-else class="btn btn-outline-warning btn-lg">
                <i class="fas fa-eye-slash mr-2"></i>Draft
              </button>
            </td>
            <td>
              <router-link
                :to="`/update-post/${post.slug}`"
                class="btn btn-outline-warning btn-lg mr-2"
              >
                <i class="fas fa-pen"></i>
              </router-link>
              <button
                @click="removepost(post['slug'])"
                class="btn btn-outline-danger btn-lg mr-2 mt-2"
              >
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
            <td>{{ post["user"]["name"] }}</td>
          </tr>
          <tr>
            <td
              v-if="isShowing()"
              class="text-center text-uppercase text-danger h4"
              colspan="8"
            >
              No post Found!
            </td>
          </tr>
          <tr v-if="IsSelected">
            <td colspan="8" class="text-left">
              <button @click="ActiveALLPost(postIDS, 1)" class="btn btn-outline-success btn-lg ml-2">
                <i class="fas fa-eye"></i>
              </button>
              <button @click="ActiveALLPost(postIDS, 0)" class="btn btn-outline-warning btn-lg ml-2">
                <i class="fas fa-eye-slash"></i>
              </button>
              <button
                @click="deleteAllPosts(postIDS)"
                class="btn btn-outline-danger btn-lg ml-2"
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
  data() {
    return {
      postIDS: [],
      SelectAll: false,
      IsSelected: false,
    };
  },
  mounted() {
    this.$store.dispatch("getPosts");
  },
  watch: {
    postIDS(value) {
      this.IsSelected = value.length > 0;
      this.SelectAll = this.posts.length == value.length;
    },
  },
  computed: {
    posts() {
      return this.$store.getters.AllPosts;
    },
  },
  methods: {
    SelectAllPost(event) {
      if (event.target.checked == false) {
        this.postIDS = [];
      } else {
        this.posts.forEach((post) => {
          this.postIDS.push(post.id);
        });
      }
    },
    isShowing() {
      return this.posts.length < 1;
    },
    // Active Multiple Category
    ActiveALLPost(postIDS , status){
        axios.post("/active-posts", {data: postIDS, status}).then((response) =>{
            toastr.info(response.data.total + ' ' + 'Action Has Been Success');
            this.$store.dispatch('getPosts');
            this.postIDS= [];
             this.SelectAll= false;
             this.IsSelected= false;
        }).catch((error) =>{
           toastr.warning(error);
        });
    },
    // Delete All Post
    deleteAllPosts(postIDS) {
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
              .post("/delete-posts", { data: postIDS })
              .then((response) => {
                toastr.info(
                  response.data.total + " " + "Post Has Been Deleted"
                );
                this.postIDS= [];
                this.SelectAll= false;
                this.IsSelected= false;
              })
              .catch((message) => {
                toastr.warning(message);
              });
            swalWithBootstrapButtons.fire(
              "Deleted!",
              "Category Has Been Deleted.",
              "success"
            );
            this.$store.dispatch("getPosts");
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
    removepost(slug) {
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
            axios.delete("remove-post/" + slug).then((response) => {
              toastr.success("category Deleted Success");
            });
            swalWithBootstrapButtons.fire(
              "Deleted!",
              "Category Has Been Deleted.",
              "success"
            );
            this.$store.dispatch("getPosts");
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
.swal2-container.swal2-backdrop-show,
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
