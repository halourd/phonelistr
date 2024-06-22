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
            <div>
                <input type="text" name="contact_name" class="p-4 w-full border rounded-md" v-model="contact_name" required>
            </div>

            <label for="contact_number">Number</label>
            <div>
                <input type="text" name="contact_number" class="p-4 w-full border rounded-md" v-model="contact_number" required>
            </div>

            <div>
                <button type="submit" class="bg-blue-400 rounded-md w-full py-2 mt-4 text-white">Create New Contact</button>
            </div>
        </form>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            contact_name: '',
            contact_number: '',
            errorMessages: null
        }
    },
    methods: {
        async submitNewContact() {
            try {
                await axios.post("/api/contacts/create", {
                    contact_name: this.contact_name,
                    contact_number: this.contact_number
                }).then((result) => {
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