import Admin from './components/Admin.vue';
import UserPage from './components/usersPage/UserPage.vue';
import DisplayUsers from './components/usersPage/DisplayUsers.vue';
import PostPage from './components/postPage/PostPage.vue';
import RolesPage from './components/rolesPage/RolesPage.vue';
import TaskPage from './components/taksPage/TaskPage.vue';
import Chat from './components/shared/Chat.vue';
import GroupChat from './components/shared/GroupChat.vue';

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
    },

    {
        name: 'tasks',
        path: '/admin/tasks',
        component: TaskPage
    },
    {
        name: 'chat',
        path: '/admin/chat/',
        component: Chat
    }
,
{
    name: 'group-chat',
    path: '/admin/groupChat/:preselectedChannel',
    component: GroupChat
},
    {
        name: 'chatPreselect',
        path: '/admin/chat/:preselectedChannel',
        component: Chat
    }
];
