<template>
  <div class="">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tags</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link to="/tag" href="#">Tag</router-link>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <div class="card">
      <div class="card-header flex card-tools">
        <h5 class="text-uppercase" style="display: inline">Tags</h5>
        <router-link
          to="/create-tag"
          class="text-uppercase btn btn-outline-danger btn-md float-right text-white"
          >Add New Tag</router-link
        >
      </div>
      <div class="card-body">
        <table class="table table-control table-bordered text-center">
          <tr>
            <td>
              <div class="icheck-success d-inline">
                <input @click="SelectAllTag" v-model="AllTagIds" type="checkbox" id="checkboxSuccess1" />

              </div>
            </td>
            <td>ID.</td>
            <td>Name</td>
            <td>Status</td>
            <td>Action</td>
            <td>Created At</td>
          </tr>

          <tr v-for="(tag, index) in tags" :key="index">
            <td class="">
              <input
                type="checkbox"
                :value="tag.id"
                v-model="TagIDS"
                id="checkboxSuccess1"
              />
            </td>
            <td>{{ index + 1 }}</td>
            <td class="h5">{{ tag["name"] }}</td>
            <td>
              <button @click="deactiveOne(tag.id)"
                v-if="tag['status'] == 1"
                class="btn btn-outline-success btn-lg"
              >
                <i class="fas fa-eye mr-2"></i>Active
              </button>
              <button @click="activeOne(tag.id)" v-else class="btn btn-outline-warning btn-lg">
                <i class="fas fa-eye-slash mr-2"></i>Deactive
              </button>
            </td>
            <td>
              <router-link
                :to="`/update-tag/${tag.slug}`"
                class="btn btn-outline-warning btn-lg mr-2"
              >
                <i class="fas fa-pen"></i>
              </router-link>
              <button
                @click="removeTag(tag['slug'])"
                class="btn btn-outline-danger btn-lg mr-2"
              >
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
            <td>{{ tag["created_at"] }}</td>
          </tr>
          <tr v-if="isShowing()">
            <td class="text-center text-uppercase text-danger h4" colspan="6">
              No Tag Found!
            </td>
          </tr>
          <tr v-if="isSelected">
            <td class="text-left text-uppercase text-danger h4" colspan="6">

            <!-- Active Button  -->
             <button @click="ActiveAllSelectedTag(TagIDS)" class="btn btn-outline-success btn-lg"> <i class="fas fa-eye    "></i></button>
             <!-- Deactive Button  -->
             <button @click="DeactiveAllSelectedTag(TagIDS)" class="btn btn-outline-warning btn-lg"> <i class="fas fa-eye-slash    "></i></button>
             <!-- Delete Button  -->
             <button @click="DeleteAllSelectedTags(TagIDS)" class="btn btn-outline-danger btn-lg"> <i class="fas fa-trash    "></i></button>
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
        TagIDS: [],
        AllTagIds:false,
        isSelected:false,
    };
  },
  mounted() {
    this.$store.dispatch("getTags");
  },
  computed: {
    tags() {
      return this.$store.getters.AllTags;
    },
  },
  watch:{
      TagIDS(TagIDS){
          this.isSelected = TagIDS.length >0;
          this.AllTagIds  = (TagIDS.length == this.SelectAllTag.length);
      }
  },
  methods: {
      DeleteAllSelectedTags(TagIDS){
          axios.post("/delete-tags",{data:TagIDS}).then((response) =>{
             toastr.success('Tags Deleted Success');
             this.$store.dispatch('getTags')
          }).catch((error) =>{
              toastr.warning(error);
          });
      },
      SelectAllTag(event){
        if(event.target.checked == false){
            this.TagIDS = [];
        } else{
           this.tags.forEach((tag) => {
               this.TagIDS.push(tag.id)
           });
        }
      },
      activeOne(id){
        axios.post("/active-tag/" + id).then((response) =>{
           toastr.success('Tag SuccessFully Actived');
           this.$store.dispatch('getTags') ;
        }).catch((error) =>{

        });
      },
      deactiveOne(id){
        axios.post("/deactive-tag/" + id).then((response) =>{
           toastr.success('Tag SuccessFully Deactive');
           this.$store.dispatch('getTags') ;
        }).catch((error) =>{

        });
      },
    isShowing() {
      return this.tags.length < 1;
    },
    removeTag(slug) {
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
            axios.delete("/delete-tag/" + slug).then((response) => {
              toastr.success("Tag Deleted Success");
            });
            swalWithBootstrapButtons.fire(
              "Deleted!",
              "Category Has Been Deleted.",
              "success"
            );
            this.$store.dispatch("getTags");
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
.swal2-container.swal2-backdrop-show, .swal2-container.swal2-noanimation {
  background: rgb(0 71 202 / 38%);
}
.dark-mode .swal2-popup {
  background-color: #343a40e6;
  color: #e9ecef;
  padding-bottom: 40px;
}
#checkboxSuccess1{
    height:22px;
    width: 25px;
}
</style>
