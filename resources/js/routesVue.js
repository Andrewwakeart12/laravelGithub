import Admin from './components/Admin.vue';
import UserPage from './components/usersPage/UserPage.vue';
import DisplayUsers from './components/usersPage/DisplayUsers.vue';
import PostPage from './components/postPage/PostPage.vue';
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
        name: 'posts',
        path: '/admin/posts',
        component: PostPage
    },
    {
        name: 'roles',
        path: '/admin/roles',
        component: RolesPage
    }
];
