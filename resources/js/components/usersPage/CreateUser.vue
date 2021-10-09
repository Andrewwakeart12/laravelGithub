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
        <th>Profile Photo</th>
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
            <td><input name="file" type="file" class="userInputInTable" v-on:change="insertedFile" ></td>
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
                insertedFile(file){
                     if(file){
                        this.formObj = new FormData()
                        this.formObj.append('photo_id', file.srcElement.files.item(0));
                        return 0;
                    }
                },
                createUser(){
                console.log(this.formObj.get('photo_id'));
                  var token = this.getTokenJson(this.$apiKey);
                  this.formObj.append('username', this.user.username);
                  this.formObj.append('email', this.user.email);
                  this.formObj.append('firstName', this.user.firstName);
                  this.formObj.append('lastName', this.user.lastName);
                  this.formObj.append('password', this.user.password);
                  this.formObj.append('password_confirmation', this.user.password_confirmation);
                  this.formObj.append('role_id', this.user.role_id);
                  this.formObj.append('is_active', this.user.is_active);



                     axios
                .post(route('users.store', token), this.formObj)
                .then(response=> { this.ServerMessage = response.data
                    console.log(response.data)
                }

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
                    role_id:[],
                    photo_id:[],

                },
                formObj: [],
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
