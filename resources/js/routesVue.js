import Admin from './components/Admin.vue';
import UserPage from './components/UserPage.vue';
import DisplayUsers from './components/DisplayUsers.vue';
import EditUser from './components/EditUser.vue';

export const routesVue = [
    {
        name: 'admin',
        path: '/admin',
        component: Admin
    },
    {
        name: 'user',
        path: '/admin/users',
        component: UserPage
    },
    {
        name: 'edit.user',
        path: '/admin/edit/:id',
        component: EditUser
    }
];
