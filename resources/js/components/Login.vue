<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Login</div>

          <div class="card-body">

            <form @submit.prevent="submit">


              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" v-model="form.email"
                          autofocus>
                  <span class="text-danger text-center" v-if="errors.email">{{errors.email[0]}}</span>

                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control"
                         name="password" v-model="form.password">
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary" @click.prevent="loginUser">
                    Login
                  </button>
                </div>
              </div>



            </form>


          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        email: '',
        password: ''
      },
      errors: []
    }
  },
  methods: {
    loginUser() {
      axios.post('/api/login', this.form).then((res) => {
        // localStorage.setItem('accessToken',res.data.data.access_token)
        // context.commit('setToken',res.data.data.access_token)
        this.$router.push({name: "Dashboard"});
      }).catch((error) => {
        this.errors = error.response.data.errors;
      })
    }
  }
}
</script>
