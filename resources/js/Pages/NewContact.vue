<template>
    <div class="my-2 mt-10">
        <p class="font-bold">Add New Contact</p>
    </div>

    <div class="shadow-lg rounded-md">
        <form method="POST" @submit.prevent="submitNewContact" class="p-6">
            <div v-if="errorMessages">
                <ul class="my-4 p-2 w-full bg-rose-100">
                    <li v-for="error in errorMessages">{{ error[0] }}</li>
                </ul>
            </div>

            <label for="contact_name">Contact Name</label>
            <div class="mb-4">
                <input type="text" name="contact_name" placeholder="Enter your contact name" minlength="3" class="p-4 w-full border rounded-md" v-model="contact_name" required>
            </div>

            <label for="contact_number">Number</label>
            <div>
                <input type="text" name="contact_number" placeholder="3 to 15-digit number" minlength="3" maxlength="15" class="p-4 w-full border rounded-md" @input="inputNumber" v-model="contact_number" required>
            </div>

            <div>
                <button type="submit" class="bg-blue-400 rounded-md w-full py-2 mt-4 text-white">Create New Contact</button>
            </div>
        </form>
    </div>
</template>
 
<script>
import {validateNumber} from '../helper/DigitValidator.js'

export default {
    data() {
        return {
            contact_name: '',
            contact_number: '',
            errorMessages: null
        }
    },
    methods: {
        inputNumber(e) {
            this.contact_number = validateNumber(e.target.value)
        },
        async submitNewContact() {
            try {
                await axios.post("/api/contacts/create", {
                    contact_name: this.contact_name,
                    contact_number: this.contact_number
                }).then((result) => {
                    alert(result.data.message)
                    this.$router.push('/')
                }).catch((error) => {
                    if (error.response && error.response.data) {
                        this.errorMessages = error.response.data.error
                    } else {
                        alert('There was an error creating the contact. Please try again.');
                    }
                });
                
            } catch (error) {
                alert('There was an error occured')
            }
        }
    }
}
</script>