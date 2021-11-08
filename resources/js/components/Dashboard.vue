<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>

                        <div class="card-body">

                            Name: {{user.name}} <br>
                            Email: {{user.email}}<br><br>
                            <button @click.prevent="logout">Logout</button>



                        </div>
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
            user: null
        }
    },
    mounted() {
        axios.get('/api/user').then((res) => {
            this.user = res.data
        })
    },
    methods: {
        logout() {
            axios.post('/api/logout').then( (res) => {
                this.$router.push({
                    name: 'Home'
                });
            })

        }
    }
}
</script>
