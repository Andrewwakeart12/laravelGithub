<template>
<div class="container">
    <ul v-for="user of users">
        <li>{{user.username}}</li>
         <li>{{user.firstName +" " + user.lastName}}</li>
        <li>{{user.email}}</li>
        <li>{{user.role ? user.role.name : 'role no asignado'}}</li>
            <li>{{user.api_token}}</li>
            <li>{{user.is_active}}</li>

    </ul>
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

                  getUsers(apiKey)
                  {
                        axios
                .get(route('users.index', apiKey ))
                .then(response=> {this.users=response.data;});
                    },

                getTokenJson(apiKey)
                {
                    var token = apiKey;
                    console.log('token : ' + token);
                    return {api_token : token};
                },
                        },
       data: function(){
           return {
                api_key: [],
                users: []
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
