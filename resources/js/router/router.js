import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: () => import('../Pages/Contacts.vue')
    },
    {
        path: '/contacts',
        name: 'Contacts',
        component: () => import('../Pages/Contacts.vue')
    },
    {
        path: '/contacts/add',
        name: 'Add New Contact',
        component: () => import('../Pages/NewContact.vue')
    },
    {
        path: '/contacts/:id/edit',
        name: 'Edit Contact',
        props: true,
        component: () => import('../Pages/EditContact.vue')
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;