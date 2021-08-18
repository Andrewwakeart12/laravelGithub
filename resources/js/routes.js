import Admin from './components/Admin.vue';
import CreateUser from './components/CreateUser.vue';
import EditUser from './components/EditUser.vue';

export const routes = [
    {
        name: 'admin',
        path: '/admin',
        component: Admin
    },
    {
        name: 'create',
        path: '/admin/create',
        component: CreateUser
    },
    {
        name: 'edit.user',
        path: '/admin/edit/:id',
        component: EditUser
    }
];
