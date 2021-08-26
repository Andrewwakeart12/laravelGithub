<template>
<div class="container-fluid">
<h1>Roles page</h1>
<div class="tableContainer row col-md-12"  v-for="role of roles">
 <table class="table table-dark responsive table-striped ">
    <thead>
        <th>TestOne</th>
    </thead>
            {{dataEditableTest}}
    <tbody>
            <tr>
            <td>
                <input name="data" class="userInputInTable" placeholder="Enter your username" v-model="dataEditableTest.username" v-on:blur="dataEditableTest"/>
            </td>
            </tr>
    </tbody>
</table>
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
            <td ><input type="checkbox" v-model="role.permissions.events.create" name="permissions-events-create" id="" :checked="role.permissions.events.create">
            <td ><input type="checkbox" v-model="role.permissions.events.read" name="permissions-events-read" id="" :checked="role.permissions.events.read"></td>
            <td ><input type="checkbox" v-model="role.permissions.events.update" name="permissions-events-update" id="" :checked="role.permissions.events.update"></td>
            <td ><input type="checkbox" v-model="role.permissions.events.delete" name="permissions-events-delete" id="" :checked="role.permissions.events.delete"></td>
            </tr>
            <tr><th>Posts</th>
            <td ><input type="checkbox" v-model="role.permissions.posts.create"name="permissions-posts-create" id="" :checked="role.permissions.posts.create">
            <td ><input type="checkbox" v-model="role.permissions.posts.read"name="permissions-posts-read" id="" :checked="role.permissions.posts.read"></td>
            <td ><input type="checkbox" v-model="role.permissions.posts.update"name="permissions-posts-update" id="" :checked="role.permissions.posts.update"></td>
            <td ><input type="checkbox" v-model="role.permissions.posts.delete"name="permissions-posts-delete" id="" :checked="role.permissions.posts.delete"></td>

            </tr>

            <tr><th>Tasks</th>
            <td ><input type="checkbox" v-model="role.permissions.tasks.create"name="permissions-tasks-create" id="" :checked="role.permissions.tasks.create">
            <td ><input type="checkbox" v-model="role.permissions.tasks.read"name="permissions-tasks-read" id="" :checked="role.permissions.tasks.read"></td>
            <td ><input type="checkbox" v-model="role.permissions.tasks.update"name="permissions-tasks-update" id="" :checked="role.permissions.tasks.update"></td>
            <td ><input type="checkbox" v-model="role.permissions.tasks.delete"name="permissions-tasks-delete" id="" :checked="role.permissions.tasks.delete"></td>

            </tr>
            <tr><th>Roles</th>
             <td ><input type="checkbox" v-model="role.permissions.roles.create"name="permissions-roles-create" id="" :checked="role.permissions.roles.create">
            <td ><input type="checkbox"  v-model="role.permissions.roles.read"name="permissions-roles-read" id="" :checked="role.permissions.roles.read"></td>
            <td ><input type="checkbox"  v-model="role.permissions.roles.update"name="permissions-roles-update" id="" :checked="role.permissions.roles.update"></td>
            <td ><input type="checkbox"  v-model="role.permissions.roles.delete"name="permissions-roles-delete" id="" :checked="role.permissions.roles.delete"></td>

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

            methods:
            {   getApiKey()
            {
                        axios
                .post(route('getApiKey'))
                .then(response=> {
                    this.api_key = response.data;
                 });

                    },
            getRoles(){
                axios
                .get(route('options'))
                .then(response=> {
                    this.roles=response.data;

                });
            },
            dataTest(data){
                console.log(data);
            },

            getTokenJson(apiKey,role)
                {if(role){
                    var token = apiKey;
                    return {api_token : token , id : role.id, role: role};

                }else{
                    var token = apiKey;
                    console.log('token : ' + token);
                    return {api_token : token};
                }
                },
                 setPermissions(role){
                var token = this.getTokenJson(this.api_key,role);
                 console.log()
                 axios
                .patch(route('roles.update', token ),role)
                .then(response=> {
                    console.log(response.data);
                    });
            },
                getContentEditable(dataEditableTest){
                    console.log(dataEditableTest);
                }
            ,
        },
       data() {

            return {
                api_key: [],
                roles :[],
                dataEditableTest:{},

        }
            }
        ,
        beforeMount(){
                this.getRoles();
                this.getApiKey();
                console.log('apiKey function executed');
        }
        ,

        mounted() {

                    console.log('COMPONENT Role Page MOUNTED');

                },

    }
</script>
