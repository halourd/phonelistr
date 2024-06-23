<template>
    <div class="my-2 mt-10">
        <p class="font-bold">List of Contacts</p>
    </div>
    <div v-if="isLoading">
        <SkeletalLoader :count="10"/>
     </div>
     <div v-else>
        <div v-if="contacts.length > 0">
            <ul v-for="contact in contacts" :key="contact.id" class="list-item shadow-lg">
                <li>
                    <div class="p-4" style="display: flex; justify-content: space-between;">
                        <div class="truncate">
                            <span class="text-md text-gray-500 font-bold">{{ contact.contact_name }}</span>
                            <br/>
                            <p class="truncate">{{ contact.contact_number }}</p>
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
     </div>
</template>

<script>
import axios from 'axios';
import SkeletalLoader from '../components/SkeletalLoader.vue';

export default {
    data(){
        return {
            contacts: [],
            isLoading: false
        }
    },
    components: {
        SkeletalLoader
    },
    created() {
        this.getContacts();
    },
    methods: {
        async getContacts(){
            try {
                this.isLoading = true;
                let result = await axios.get('api/contacts');
                this.contacts = result.data;
            } catch (error) {
                alert(error.message);
            } finally {
                this.isLoading = false;
            }
        },

        async deleteContact(id){
            if(!confirm('Are you sure you want to delete this contact?')){
                return false;
            }
            try {
                let result = await axios.delete(`api/contacts/${id}`);
                if(result){
                    alert('Contact Deleted Successfully');
                }
                this.getContacts();
            } catch (error) {
                alert(error.message);
            }
        },
        async editContact(id, name, number){
            await axios.get('api/contacts/:id/edit')
                .then((response)=>{
                    this.$router.push({name:"Edit Contact", params: {id:id}});
                })
                .catch((error)=>{
                    alert(error.message);
                })
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