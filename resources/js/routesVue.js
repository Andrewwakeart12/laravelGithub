import Admin from './components/Admin.vue';
import UserPage from './components/usersPage/UserPage.vue';
import DisplayUsers from './components/usersPage/DisplayUsers.vue';
import EditUser from './components/usersPage/EditUser.vue';
import RolesPage from './components/rolesPage/RolesPage.vue';

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
    },
    {
        name: 'roles',
        path: '/admin/roles',
        component: RolesPage
    }
];
