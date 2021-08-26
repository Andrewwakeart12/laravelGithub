<template>
<div class="col-md-auto">
     <table class="table-dark responsive table-striped ">
    <thead>
        <th scope="col">Id</th>
        <th scope="col">UserName</th>
        <th scope="col">FirstName</th>
        <th scope="col">LastName</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Is active</th>
        <th scope="col">Delete</th>
    </thead>
    <tbody>
            <tr v-for="user of users">
            <td>{{user.id}}</td>
            <td>{{user.username}}</td>
            <td>{{user.firstName}}</td>
            <td>{{user.lastName}}</td>
            <td>{{user.email}}</td>
            <td>{{user.role ? user.role.name : 'role no asignado'}}</td>
            <td>{{user.is_active}}</td>
            <td>
            <input class="btn btn-danger m-3 p-2" v-on:click="usersDeleteSet( api_key, user )" type="button" value="Delete">
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
                    this.getUsers(token);
                    console.log("mounted run time " +  this.api_key);
                    console.log('api_key seteada ' + this.api_key )
                    });
                },

                    usersDeleteSet(apiKey,user){
                        var token = this.getTokenJson(apiKey, user.id);
                        var routeR= route('users.destroy', token);
                        console.log(routeR);
                        axios
                        .delete(routeR)
                        .then(response=> {
                            console.log(response.data);});
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

                    return {api_token : token, user: id};

                    }else{
                        var token = apiKey;
                    console.log('token : ' + token);
                    return {api_token : token};

                    }
                   },
                        },
       data: function(){
           return {
                api_key: [],
                users: [],
        }

       }
        ,
         mounted()
                {
                    this.getApiKey();
                    console.log('COMPONENT USER DISPLAY MOUNTED');
                }

    }
</script>
