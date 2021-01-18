.<template>
   <div class="">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tag</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a>Tag</a>
              </li>
              <li class="breadcrumb-item active">
                <span>Create Tag</span>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <div class="card">
      <div class="card-header flex card-tools">
        <h5 class="text-uppercase" style="display: inline">Add New Tag</h5>
        <router-link
          to="/tag"
          class="text-uppercase btn btn-outline-info btn-md float-right text-white"
          >Go Back</router-link
        >
      </div>
      <div class="card-body">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title pt-2">Enter Your Tag Name</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form @submit.prevent="addTag" class="form-horizontal">
            <div class="card-body">
              <div class="form-group row">
                <label for="catname" class="col-sm-2 col-form-label"
                  >Tag Name:</label
                >
                <div class="col-sm-10">
                  <input
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    id="catname"
                    placeholder="Enter Your Tag Name"
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
                AdD New Tag
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
data() {
    return {
        form: new Form({
           name: '',
           status: false,
        }),
    };
},
methods: {
    deactive(){
      this.form.status = false;
    },
    active(){
        this.form.status = true;
    },
    addTag(){
        this.form.post('store-tag').then((response) =>{
           toastr.success('Tag Added Success');
        }).catch((error) =>{
            toastr.danger(error);
        });
    }
},


}
</script>

<style>

</style>
