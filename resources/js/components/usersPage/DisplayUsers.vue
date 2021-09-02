<template>
<div class="col-md-auto">

     <div class="alert-success" v-if="serverMessage">
        {{serverMessage.Success}}
     </div>
      <div class="alert-danger" v-if="serverMessage">
        {{serverMessage.Error}}
     </div>
     <table class="table table-dark responsive table-striped ">

    <thead>
        <th>Id</th>
        <th>UserName</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Role</th>
        <th>Is active</th>
        <th>Delete</th>
        <th>Update</th>
    </thead>
    <tbody>
            <tr v-for="user of users">
            <td>{{user.id}}</td>
            <td><input name="usernam" class="userInputInTable" placeholder="username" v-model="user.username" v-on:blur="user"/></td>
            <td><input name="firstName" class="userInputInTable" placeholder="username" v-model="user.firstName" v-on:blur="user"/></td>

            <td><input name="lastName" class="userInputInTable" placeholder="username" v-model="user.lastName" v-on:blur="user" /></td>

            <td><input name="email" type="email" class="userInputInTable email" placeholder="username" v-model="user.email" v-on:blur="user"/></td>
            <td>
            <select v-model="user.role_id">
                <option v-for="role in roles"  :value="role.id">
                    {{role.name}}
                </option>
            </select>
            </td>
            <td contenteditable="false" v-on:click="user.is_active = !user.is_active"> <button class="btn btn-warn">{{user.is_active == true ? 'Desactivar Usuario' : 'Activar usuario'}}</button> </td>
            <td>
            <input class="btn btn-danger m-3 p-2" v-on:click="usersDelete( api_key, user )" type="button" value="Delete">
            </td>
              <td>
            <input class="btn btn-danger m-3 p-2" v-on:click="usersUpdate( api_key, user )" type="button" value="Update">
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
            getApiKey()
                {
                        axios
                .post(route('getApiKey'))
                .then(response=> {
                this.api_key=response.data;
                    var token =this.getTokenJson(this.api_key);

                    this.getRoles(token);
                    this.getUsers(token);
                    console.log("mounted run time " +  this.api_key);
                    console.log('api_key seteada ' + this.api_key )
                    });
                },

                    usersDelete(apiKey,user){
                        var token = this.getTokenJson(apiKey, user.id);
                        var routeR= route('users.destroy', token);
                        console.log(routeR);
                        axios
                        .delete(routeR)
                        .then(response=> {
                            this.serverMessage=response.data;});
                    },

                    usersUpdate(apiKey,user){
                        var token = this.getTokenJson(apiKey, user.id);
                        var routeR= route('users.update', token);
                        console.log(user);
                        axios
                        .patch(routeR, user)
                        .then(response=> {
                            this.serverMessage=response.data;
                            });
                    },
                  getUsers(apiKey)
                  {
                        axios
                .get(route('users.index', apiKey ))
                .then(response=> {this.users=response.data;});
                    },

                getTokenJson(apiKey,id)
                {
                    if(id){
                    var token = apiKey;
                    console.log('token : ' + token + " id: " + id );
                    this.apiToken = token;
                    return {api_token : token, user: id};

                    }else{
                        var token = apiKey;
                    console.log('token : ' + token);
                    return {api_token : token};

                    }
                   },
                   getRoles(token){
                          axios
                .get(route('options'))
                .then(response=> {
                    this.roles=response.data;

                });
                   }
                        },
       data: function(){
           return {
                api_key: [],
                apiToken: [],
                users: [],
                roles:[],
                serverMessage:null
        }

       }
        ,
        beforeMount(){
            this.getApiKey();
            var token = this.api_token;
                    console.log(token);
        }
        ,
         mounted()
                {


                    console.log('COMPONENT USER DISPLAY MOUNTED');
                }

    }
</script>
