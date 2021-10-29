<template>
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tickets <div class="float-right" @click="show_add()" >Add</div></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="w-5">#</th>
                                <th>name</th>
                                <th>price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="ticket in tickets.data" :key="ticket.id">
                                <td class="w-5">{{ ticket.id }}</td>
                                <td>{{ ticket.name }}</td>
                                <td>{{ ticket.price }}</td>
                                <td>
                                    <a @click="editTicket(ticket)">Edit</a> |
                                    <a @click="deleteTicket(ticket.id)">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <pagination :data="tickets" @pagination-change-page="list" :limit=5 ></pagination>

                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center mt-5" v-if="addForm">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Save a ticket</div>

                    <div class="card-body"  >
                        <form @submit.prevent="submit">
                            <div class="alert alert-success" v-show="status">Success</div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" v-model="fields.name">
                                    <div class="alert alert-danger mt-2" v-if="errors && errors.name">{{ errors.name[0] }}</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price" v-model="fields.price">
                                    <div class="alert alert-danger mt-2" v-if="errors && errors.price">{{ errors.price[0] }}</div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" @click="save()" >
                                        {{ isEditing ? 'Update' : 'Add' }}
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

import pagination from 'laravel-vue-pagination'



export default {
    name:"tickets",
    components:{
        pagination
    },

    data() {

        return {
            fields: {},
            tickets: {},
            errors: {},
            temp_id: null,
            isEditing:false,
            status:false,
            addForm:false
        }
    },
    mounted() {
        this.list();
    },
    methods: {
        list(page = 1) {
            axios.get(`/api/tickets?page=${page}`)
                .then(response => {
                    this.tickets = response.data;
                });
        },
        show_add() {
            this.addForm = false;
                  this.addForm = true;
        },
        save() {

            let method = axios.post;
            let url = `/api/tickets`

            if(this.isEditing){
                method = axios.put
                url = `/api/tickets/${this.temp_id}`
            }

            method(url, this.fields)
            .then(response => {
                this.fields = {};
                this.list();
                this.status = true;
                this.isEditing = false;
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            })
        },
        editTicket(ticket) {
            this.show_add();
            this.fields = {
                name : ticket.name,
                price : ticket.price
            }
            this.temp_id = ticket.id
            this.isEditing = true
        },
        deleteTicket(id) {
            axios.delete(`/api/tickets/${id}`)
            .then(response => {
                this.list();
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            });
        }
    }

}
</script>
