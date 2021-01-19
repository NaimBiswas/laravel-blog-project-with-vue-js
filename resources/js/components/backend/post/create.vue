<template>
  <div class="">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a>Post</a>
              </li>
              <li class="breadcrumb-item active">
                <span>Create Post</span>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <div class="card">
      <div class="card-header flex card-tools">
        <h5 class="text-uppercase" style="display: inline">Add Post</h5>
        <router-link
          to="/post"
          class="text-uppercase btn btn-outline-info btn-md float-right text-white"
          >Go Back</router-link
        >
      </div>
      <div class="card-body">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title pt-2">Enter Your Info</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form @submit.prevent="addPost" class="form-horizontal">
            <div class="card-body">
              <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label"
                  >Post Title:</label
                >
                <div class="col-sm-10">
                  <input
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    id="title"
                    placeholder="Enter Your Posst Title"
                    name="title"
                    :class="{ 'is-invalid': form.errors.has('title') }"
                  />
                  <has-error :form="form" field="title"></has-error>
                </div>
              </div>
               <div class="form-group row">
                <label for="images" class="col-sm-2 col-form-label"
                  >Post Image:</label
                >
                <div class="col-sm-10">
                     <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="images">
                        <label class="custom-file-label" for="exampleInputFile">Choose File</label>
                      </div>
                    </div>
                  <has-error :form="form" field="images"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label"
                  >Post Categroy:</label
                >
                <div class="col-sm-10">
                     <select class="form-control" id="category">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                  <has-error :form="form" field="images"></has-error>
                </div>
              </div>


               <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label"
                  >Post Description:</label
                >
                <div class="col-sm-10">
                  <textarea name="description" class="form-control" id="description" cols="30" rows="10" placeholder="Enter Your Post Description"></textarea>
                  <has-error :form="form" field="description"></has-error>
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
                AdD New Post
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
        title: "",
        status: false,
        description: '',
        images: '',
        category: '',
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
      this.form.post("/store-post")
            .then((response) =>{
                 toastr.info('Category successfully created');

            }).catch((error) => {
                toastr.info(error);
            });
      this.form.title = '';
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
