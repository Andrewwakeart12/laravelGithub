<template>
<div class="col-md-auto">
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
            <td><input name="usernam" class="userInputInTable" placeholder="username" v-model="user.username" v-on:blur="user"/></td>
            <td><input name="firstName" class="userInputInTable" placeholder="firstName" v-model="user.firstName" v-on:blur="user"/></td>

            <td><input name="lastName" class="userInputInTable" placeholder="lastName" v-model="user.lastName" v-on:blur="user" /></td>

            <td><input name="email" type="email" class="userInputInTable email" placeholder="email" v-model="user.email" v-on:blur="user"/></td>
            <td><input name="password" type="password" class="userInputInTable email" placeholder="password" v-model="user.password" v-on:blur="user"/></td>
            <td><input name="password_confirmation" type="password" class="userInputInTable email" placeholder="password_confirmation" v-model="user.password_confirmation" v-on:blur="user"/></td>
            <td>{{user.role ? user.role.name : 'role no asignado'}}</td>
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
        { getApiKey()
                {
                        axios
                .post(route('getApiKey'))
                .then(response=> {this.api_key=response.data;
                    });
                }
                ,
                 getTokenJson(apiKey)
                {
                    var token = apiKey;
                    console.log('token : ' + token);
                    return {api_token : token};
                },
                createUser(){
                console.log(this.user);
                  var token = this.getTokenJson(this.api_key);
                     axios
                .post(route('users.store', token), this.user)
                .then(response=> { console.log(this.user) }

                )}

            },

        data(){
            return {
                api_key: this.getApiKey(),
                user: {
                    is_active:false,
                },
            }
        },
        mounted() {
            console.log('Component Exaple App mounted.')
        }
    }
</script>
