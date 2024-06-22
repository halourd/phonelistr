<template>
    <div class="my-2 mt-10">
        <p class="font-bold">List of Contacts</p>
    </div>
    <div v-if="contacts.length > 0">
        <ul v-for="contact in contacts" :key="contact.id" class="list-item shadow-lg">
            <li>
                <div class="p-4" style="display: flex; justify-content: space-between; max-width: 600px;">
                    <div>
                        <span class="text-xl">{{ contact.contact_name }}</span>
                        <br/>
                        {{ contact.contact_number }}
                    </div>
                    <div class="center-items">
                        <button @click="editContact(contact.id, contact.contact_name, contact.contact_number)" class="px-4 py-2 mr-2 action-btn rounded-full bg-orange-400 text-white">Edit</button>
                        <button @click="deleteContact(contact.id)" class="px-4 py-2 action-btn rounded-full bg-red-400 text-white">Delete</button>
                    </div>
                </div>
            </li>
            
        </ul>
    </div>
    <div v-else>
        <p class="text-center">No Contacts Found</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            contacts: []
        }
    },
    mounted() {
        this.getContacts();
    },
    methods: {
        async getContacts(){
            try {
                let result = await axios.get('api/contacts');
                this.contacts = result.data;
            } catch (error) {
                alert(error.message);
            }
        },

        async deleteContact(id){
            try {
                let result = await axios.delete(`api/contacts/${id}`);
                this.getContacts();
            } catch (error) {
                alert(error.message);
            }
        },
        editContact(id, name, number){
            this.$router.push({name:"Edit Contact", params: {id:id}, props: {contact_name: name, contact_number: number}});
        }

    }
}
</script>

<style scoped>
    .list-container {
        display: flex;
        justify-content: center;
    }
    .list-item{
        margin-bottom: 10px;
        max-width: 900px;
        padding: 10px;
        border-radius: 5px;
    }

    .center-items {
        display: flex;
        justify-content: center;
    }
</style>