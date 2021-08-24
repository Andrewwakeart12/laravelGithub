<template>
<div class="container-fluid">
<h1>Roles page</h1>

<div class="tableContainer row col-md-12"  v-for="role of roles">
    <input class="btn btn-danger m-3 p-2" v-on:click="setPermissions(role)" type="button" value="Actualizar datos">
     <table class="table table-dark responsive table-striped ">
    <thead>
        <th>{{role.name}}</th>
        <th>Create</th>
        <th>Read</th>
        <th>Update</th>
        <th>Delete</th>
    </thead>
    <tbody>
            <tr><th>Users</th>
            <td ><input type="checkbox" v-model="role.permissions.users.create" id="" :checked="role.permissions.users.create">
            <td ><input type="checkbox" v-model="role.permissions.users.read" id="" :checked="role.permissions.users.read"></td>
            <td ><input type="checkbox" v-model="role.permissions.users.update" id="" :checked="role.permissions.users.update"></td>
            <td ><input type="checkbox" v-model="role.permissions.users.delete" :checked="role.permissions.users.delete"></td>
            </tr>

            <tr><th>Events</th>
            <td ><input type="checkbox" name="permissions-events-create" id="" :checked="role.permissions.events.create">
            <td ><input type="checkbox" name="permissions-events-read" id="" :checked="role.permissions.events.read"></td>
            <td ><input type="checkbox" name="permissions-events-update" id="" :checked="role.permissions.events.update"></td>
            <td ><input type="checkbox" name="permissions-events-delete" id="" :checked="role.permissions.events.delete"></td>
            </tr>
            <tr><th>Posts</th>
            <td ><input type="checkbox" name="permissions-posts-create" id="" :checked="role.permissions.posts.create">
            <td ><input type="checkbox" name="permissions-posts-read" id="" :checked="role.permissions.posts.read"></td>
            <td ><input type="checkbox" name="permissions-posts-update" id="" :checked="role.permissions.posts.update"></td>
            <td ><input type="checkbox" name="permissions-posts-delete" id="" :checked="role.permissions.posts.delete"></td>

            </tr>
            <tr><th>Roles</th>
             <td ><input type="checkbox" name="permissions-roles-create" id="" :checked="role.permissions.roles.create">
            <td ><input type="checkbox" name="permissions-roles-read" id="" :checked="role.permissions.roles.read"></td>
            <td ><input type="checkbox" name="permissions-roles-update" id="" :checked="role.permissions.roles.update"></td>
            <td ><input type="checkbox" name="permissions-roles-delete" id="" :checked="role.permissions.roles.delete"></td>

            </tr>
    </tbody>
</table>
<br/>
</div>


</div>


</template>

<script>
import {route} from '../../routes.js';
    export default {

            methods:{
            getApiKey(){
                        axios
                .post(route('getApiToken'))
                .then(response=> {this.api_key=response.data;
                console.log(response.data);
                });
                    },
            getRoles(){
                axios
                .get(route('options'))
                .then(response=> {this.roles=response.data;
                console.log(response.data);});
            },
            setPermissions(role){
                console.log(role);
            }
        },
       data() {

            return {
                api_key: [],
                roles :this.getRoles(),

        }
            }
        ,
        mounted() {
                    console.log('COMPONENT ADMIN MOUNTED');
                    this.getApiKey();
                    this.getRoles();
                },

    }
</script>
