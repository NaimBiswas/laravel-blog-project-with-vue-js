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
          <form
            @submit.prevent="addPost"
            class="form-horizontal"
            enctype="multipart/form-data"
          >
            <div class="card-body">
              <!-- post title  -->
              <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Post Title:</label>
                <div class="col-sm-10">
                  <input
                    v-model="form.title"
                    type="text"
                    class="form-control"
                    id="title"
                    placeholder="Enter Your Posst Title"

                    name="title"
                    :class="{
                      'is-invalid': form.errors.has('title'),
                    }"
                  />
                  <has-error :form="form" field="title"></has-error>
                </div>
              </div>
              <!-- post images -->
              <div class="form-group row">
                <label for="images" class="col-sm-2 col-form-label">Post Image:</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="custom-file">
                      <input
                        type="file"
                        @change="LoadImage($event)"
                        class="custom-file-input"
                        id="images"
                        name="images"/>
                      <label class="custom-file-label" for="exampleInputFile"
                        >Choose File</label
                      >
                    </div><br>
                  </div>
                      <!-- priview images  -->
                      <img v-if="form.images" style="height:300px; width:250px" class="img-fluid max-width: 100%" :src="form.images" alt="">
                  <has-error :form="form" field="images"></has-error>
                </div>
              </div>
              <!-- post category  -->
              <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label"
                  >Post Categroy:</label
                >
                <div class="col-sm-10">
                  <select   class="form-control" id="category_id" v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category_id') }">
                    <option value="" selected>Select A Category</option>
                    <option  :value="category.id" v-for="(category, index ) in categories" :key="index">{{ category.name }}</option>
                  </select>
                  <has-error :form="form" field="category_id"></has-error>
                </div>
              </div>

              <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label"
                  >Post Description:</label
                >
                <div class="col-sm-10">
                  <!-- <textarea
                    name="description"
                    class="form-control"
                    id="description"
                    cols="30"
                    rows="10"
                    placeholder="Enter Your Post Description"
                  ></textarea> -->
                   <ckeditor class="form-control" :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                  <has-error :form="form" field="description"></has-error>
                </div>
              </div>
              <div class="form-group row">
                <label for="catname" class="col-sm-2 col-form-label">Status:</label>
                <div class="col-sm-10 flex">
                  <a v-if="form.status" @click="deactive" class="btn btn-success btn-md"
                    >Active</a
                  >
                  <a v-else @click="active" class="btn btn-warning btn-md">Deactive</a>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-success btn-md text-uppercase">
                AdD New Post
              </button>
              <button type="reset" class="btn btn-default float-right">Cancel</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
  name: "category",
  data() {
    return {
         editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },
      form: new Form({
        title: "",
        status: false,
        description: "",
        images: "",
        category_id: "",
      }),

    };
  },
  mounted() {
//   fetch Active Categories

    this.$store.dispatch("getActiveCategories");
  },

  computed: {
//   fetch Active Categories

categories() {
      return this.$store.getters.allActiveCategory;
    },
  },
  methods: {
    //   For Thumbail load
      LoadImage(event){

          const file = event.target.files[0];
          if(file.size <= 2098152){
              if(file.type === 'image/png'){
                    const fileReader = new FileReader();
                    fileReader.onload = event => {
                        this.form.images = event.target.result;
                    };
                fileReader.readAsDataURL(file);
              }else{
                  toastr.error('Images Must Be PNG Formated');
              }
          }else{
              toastr.error('Images Size Must Me lower Than 2048kb');
          }

      },
    active() {
      this.form.status = true;
    },
    deactive() {
      this.form.status = false;
    },
    addPost() {
      this.form
        .post("/store-post")
        .then((response) => {
          toastr.info("Post successfully created");
               this.form.title = "";
               this.form.status = false;
        })
        .catch((error) => {
              toastr.info(error);

        });

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
.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred {
    background: #343A40;
}
.ck.ck-editor__main>.ck-editor__editable {
    background: #343A40;
    border-radius: 0;
}
</style>
