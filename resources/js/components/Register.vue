<template>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>

                        <div class="card-body">
                            <form>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" v-model="forms.name"  autocomplete="name" autofocus>
                                        <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" v-model="forms.email"  autocomplete="email">
                                        <span class="text-danger" v-if="errors.email">{{errors.email[0]}}</span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" v-model="forms.password"  autocomplete="new-password">
                                        <span class="text-danger" v-if="errors.password">{{errors.password[0]}}</span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="forms.password_confirmation" autocomplete="new-password">
                                        <span class="text-danger" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</span>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" @click.prevent="register" >
                                            Register
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
            forms:{
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: []
        }
    },
    mounted() {
        //
    },
    methods: {
        register() {

            axios.post(`/api/register`, this.forms)
            .then(response => {
                this.$router.push({name: "Dashboard"})
                console.errors('saved')
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    }

}
</script>
