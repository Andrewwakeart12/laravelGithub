<template>
<div class="col-md-auto">
<div class="alert-success" v-if="ServerMessage">
        {{this.ServerMessage.Success}}
     </div>
     <div class="alert-danger" v-if="ServerMessage">
        {{this.ServerMessage.Error}}
     </div>
     <table class="table table-dark responsive table-striped ">

    <thead>
        <th>UserName</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Password</th>
        <th>Password Confirmation</th>
        <th>Role</th>
        <th>Is active</th>
        <th>Create</th>
    </thead>
    <tbody>
            <tr>
            <td><input name="usernam" class="userInputInTable" placeholder="username" v-model="user.username" /></td>
            <td><input name="firstName" class="userInputInTable" placeholder="firstName" v-model="user.firstName" /></td>

            <td><input name="lastName" class="userInputInTable" placeholder="lastName" v-model="user.lastName"  /></td>

            <td><input name="email" type="email" class="userInputInTable email" placeholder="email" v-model="user.email" /></td>
            <td><input name="password" type="password" class="userInputInTable email" placeholder="password" v-model="user.password" /></td>
            <td><input name="password_confirmation" type="password" class="userInputInTable email" placeholder="password_confirmation" v-model="user.password_confirmation" /></td>
            <td>
            <select v-model="user.role_id">
                <option v-for="role in roles"  :value="role.id">
                    {{role.name}}
                </option>
            </select></td>
            <td contenteditable="false" v-on:click="user.is_active = !user.is_active"> <button class="btn btn-warn">{{user.is_active == true ? 'Desactivar Usuario' : 'Activar usuario'}}</button> </td>
            <td>
            <input class="btn btn-danger m-3 p-2" v-on:click="createUser()" type="button" value="Create">
            </td>
            </tr>
    </tbody>
</table>
<br/>
</div>
</template>

<script>
import {route} from '../../routes.js';
    export default {
        methods:
        {
                 getTokenJson(apiKey)
                {
                    var token = apiKey;
                    console.log('token : ' + token);
                    return {api_token : token};
                },
                createUser(){
                console.log(this.user);
                  var token = this.getTokenJson(this.$apiKey);
                     axios
                .post(route('users.store', token), this.user)
                .then(response=> { this.ServerMessage = response.data }

                )},
                  getRoles(){
                      var token=this.$apiKey;
                       token = {api_token : token};
                          axios
                .get(route('getRoles', token))
                .then(response=> {
                    this.roles=response.data;

                });
                   }

            },

        data(){
            return {
                user: {
                    is_active:false,
                    role_id:[]
                },
                role: [],
                roles:[],
                ServerMessage: []
            }
        },
        mounted() {
            this.getRoles();
            console.log('Component Exaple App mounted.')
        }
    }
</script>
