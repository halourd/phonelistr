<template>
    <div class="my-2 mt-10">
        <p class="font-bold">Edit Contact</p>
    </div>
    <div class="shadow-lg rounded-md">
        <form method="POST" @submit.prevent="editContact" class="p-6">
            <div v-if="errorMessages" >
                <ul class="my-4 p-2 w-full bg-rose-100">
                    <li class="text-rose-500" v-for="error in errorMessages">{{ error[0] }}</li>
                </ul>
            </div>

            <label for="contact_name">Contact Name</label>
            <div>
                <input type="text" name="contact_name" class="p-4 w-full border rounded-md" v-model="contact_name" required>
            </div>

            <label for="contact_number">Number</label>
            <div>
                <input type="text" name="contact_number" class="p-4 w-full border rounded-md" v-model="contact_number" required>
            </div>

            <div>
                <button type="submit" class="bg-orange-400 rounded-md w-full py-2 mt-4 text-white">Update</button>
            </div>
            <div>
                <button @click="$router.push('/')" class="rounded-md w-full py-2 mt-4 ">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            id: '',
            contact_name: '',
            contact_number: '',
            errorMessages: null
        }
    },
    props: ['id'],
    mounted(){
        this.fetchContactDetail(this.$route.params.id)
    },
    methods: {
        async fetchContactDetail(id){
            await axios.get(`/api/contacts/${id}`)
                .then((result) => {
                    this.id = result.data.id,
                    this.contact_name = result.data.contact_name,
                    this.contact_number = result.data.contact_number
                }).catch((err) => {
                    alert(err.response.data);
                });

        },
        async editContact() {
            try {
                console.log({
                    id: this.$route.params.id,
                    contact_name: this.contact_name,
                    contact_number: this.contact_number
                })
                await axios.put(`/api/contacts/${this.$route.params.id}`, {
                    id: this.$route.params.id,
                    contact_name: this.contact_name,
                    contact_number: this.contact_number
                })
                    .then((result) => {
                        console.log(result)
                        this.$router.push('/')
                    }).catch((err) => { 
                        this.errorMessages = err.response.data.error
                    });
            } catch (error) {
                
            }
        }
    },
    formatErrors(errorMessages) {
      return errorMessages.join(', ');
    }
}
</script>

<style>
    .field {
        border: 1px solid #ccc;
    }
</style>