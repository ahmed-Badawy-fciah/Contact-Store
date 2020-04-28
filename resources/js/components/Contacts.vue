<template>
    <div class="container">
            <h1  v-show="!edit">Add Contact</h1>
            <h1  v-show="edit">Edit Contact</h1>
            <div class="form-group">
                <button  class="btn btn-secondary float-right" @click="back">Clear</button>   
            </div>
        <form action="#" @submit.prevent="edit ? updateContact(contact.id) : createContact()">
            <div class="form-group">
                <label>Name</label>
                <input v-model="contact.name" type="text" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input v-model="contact.email" type="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input v-model="contact.phone" type="phone" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <button v-show="!edit" type="submit" class="btn btn-primary">New Contact</button>
                <button v-show="edit" type="submit" class="btn btn-primary">Edit Contact</button> 
                
            </div>
        </form>
        <h1 > Contacts</h1>
        <ul class="list-group">
            <li class="list-group-item" v-for="contact in list">
            <strong class="text-danger">{{contact.name}}</strong> {{contact.email}} {{contact.phone}}
            <button @click="deleteContact(contact.id)" class="btn btn-danger btn-xs float-right">Delete</button>
            <button @click="showContact(contact.id)" class="btn btn-xs float-right">Edit</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                edit:false,
                list:[],
                contact:{
                    id:'',
                    name:'',
                    email:'',
                    phone:''
                }
            }
        },
        mounted: function(){
            console.log('Contacts component loaded....');
            this.fetchContactList();
        },
        methods: {
            fetchContactList:function(){
                console.log('fetching contacts....');
                axios.get('api/contacts')
                    .then((response)=>{
                        console.log(response.data);
                        this.list = response.data;
                    })
                    .catch((error)=> {
                        console.log(error);
                    });
            },
            createContact: function(){
                console.log('Contact is added...');
                let self = this;
                let params =Object.assign({} , self.contact);
                console.log(self.contact.name);
                
                axios.post('api/contact/store' , params)
                    .then(function(){
                        self.contact.name = '';
                        self.contact.email = '';
                        self.contact.phone = '';
                        self.edit = false;
                        self.fetchContactList();
                    })
                    .catch(function(error){
                        console.log(error);
                    });
            },
            showContact: function(id){
                let self = this;
                axios.get('api/contact/' + id )
                .then(function(response){
                    self.contact.id = response.data.id;
                    self.contact.name = response.data.name;
                    self.contact.email = response.data.email;
                    self.contact.phone = response.data.phone;
                })
                self.edit = true;
            },
            updateContact: function(id){
                console.log('Contact is Updated...');
                let self = this;
                let params =Object.assign({} , self.contact);
                console.log(self.contact.name);
                
                axios.patch('api/contact/'+id, params )
                    .then(function(){
                        self.contact.name = '';
                        self.contact.email = '';
                        self.contact.phone = '';
                        self.edit = false;
                        self.fetchContactList();
                    })
                    .catch(function(error){
                        console.log(error);
                    });
            },
            deleteContact: function(id){
                console.log('contact is deleted....');
                let self = this ;
                axios.delete('api/contact/' + id)
                .then(function(){
                        self.fetchContactList();
                    })
                    .catch(function(error){
                        console.log(error);
                    });
            },
            back: function(){
                console.log('Back to create');
                let self = this ;
                    self.contact.name = '';
                    self.contact.email = '';
                    self.contact.phone = '';
                    self.edit = false;
            }
        }
        
    }
</script>