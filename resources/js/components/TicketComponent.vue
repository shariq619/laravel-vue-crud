<template>
    <div class="container">


        <div class="row justify-content-center" v-if="tickets.length > 0">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tickets <span class="float-right">Add a ticket</span></div>
                    <div class="card-body">
                        <div class="alert alert-success" v-show="delete_success">Ticket deleted succesfully</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">price</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="ticket in tickets">
                                <th scope="row">{{ ticket.id }}</th>
                                <td>{{ ticket.name }}</td>
                                <td>{{ ticket.price }}</td>
                                <td>
                                    <a @click="editTicket(ticket)">Edit</a> |
                                    <a @click="deleteTicket(ticket.id)">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center mt-5" >
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Save a ticket</div>

                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="alert alert-success" v-show="add_success">Ticket {{  isEditing ? "Update" : "Add"}} succesfully</div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" v-model="fields.name">
                                    <div class="alert  alert-danger mt-1" v-if="errors && errors.name">{{errors.name}}</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price"
                                           v-model="fields.price">
                                    <div class="alert  alert-danger mt-1" v-if="errors && errors.price">{{errors.price}}</div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button @click="save()" type="submit" class="btn btn-primary">
                                        {{  isEditing ? "Update" : "Add"}}
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
            tickets: [],
            fields: {},
            add_success: false,
            delete_success: false,
            errors: {},
            temp_id: null,
            isEditing: false
        }
    },
    mounted() {
        this.list();
    },
    methods: {
        list() {
            axios.get('/api/tickets').then(
                response => {
                    this.tickets = response.data.data;
                }
            );
        },
        save() {

            let method = axios.post;
            let url = '/api/tickets';

            if(this.isEditing){
                method = axios.put;
                url =  `/api/tickets/${this.temp_id}`
            }

            method(url, this.fields).then(
                response => {
                    this.fields = {};
                    this.add_success = true;
                    this.delete_success = false;
                    this.errors = {};
                    this.list(this.temp_id);
                }).catch(error => {
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors;
                    this.delete_success = false;
                }
                console.log('Errors');
            });

        },
        editTicket(ticket) {
            this.fields = {
                name: ticket.name,
                price: ticket.price
            }
            this.temp_id = ticket.id;
            this.isEditing = true;
        },
        deleteTicket(id) {
            axios.delete(`/api/tickets/${id}`)
                .then(response => {
                    this.delete_success = true;
                    this.add_success = false;
                    this.list()
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.add_success = false;
                });
        }
    }
}
</script>
