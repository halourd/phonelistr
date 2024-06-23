<template>
    <div class="wrapper h-screen">
        <div class="container">
            <h1 class="my-6 text-xl">Harold's Phone Book</h1>
            <nav class="align-right">
                <button @click="navigateToHome" class="px-4 py-2 mr-2 shadow-md rounded-full">Home</button>
                <button @click="navigateToAddContact" class="px-4 py-2 shadow-lg shadow-blue-100 rounded-full bg-blue-300">+ Add New Contact</button>
            </nav>
            <RouterView />
        </div>
    </div>
</template>

<script>
export default {
    name: 'App',
    methods: {
        navigateToHome(){
            this.$router.push('/');
        },
        navigateToAddContact(){
            this.$router.push('/contacts/add');
        }
    }
};
</script>
<style scoped>
    .container {
        max-width: 500px;
    }
    .wrapper {
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        align-items: center;
        margin: 20px;

    }
</style>