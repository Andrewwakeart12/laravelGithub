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
        <th>Profile Image</th>
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
            <input name="old_photo_id" type="hidden"  v-model="user.photo_id"/>
            <td>
            <div>
            <input name="file" type="file" class="userInputInTable" v-on:change="insertedFile" :userId="user.id">
            </div>
            <div v-if="user.profilePhoto">
                <img class="img img-fluid" :src="user.profilePhoto"/>
            </div>
            </td>

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
              insertedFile(file){
                     if(file){
                        this.formObj = new FormData()
                        this.formObj.append('new_photo_id', file.srcElement.files.item(0));
                        this.formObj.append('user_id_for_photo', file.srcElement.getAttribute('userId'))
                        return 0;
                    }
                },
            setViewData()
                {
                        var token =this.getTokenJson(this.$apiKey);
                    this.getRoles(token);
                    this.getUsers(token);
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
                         if(this.formObj != null){
                             console.log(this.formObj.get('new_photo_id'));
                            this.formObj.append('username', user.username);
                            this.formObj.append('email', user.email);
                            this.formObj.append('firstName', user.firstName);
                            this.formObj.append('lastName', user.lastName);
                            this.formObj.append('role_id', user.role_id);
                            this.formObj.append('old_photo_id', user.photo_id);

                            this.formObj.append('is_active', user.is_active);
                            this.formObj.append('_method', 'PATCH');
                         }else{
                             console.log("else");
                             this.formObj= new FormData();

                            this.formObj.append('username', user.username);
                            this.formObj.append('email', user.email);
                            this.formObj.append('firstName', user.firstName);
                            this.formObj.append('lastName', user.lastName);
                            this.formObj.append('role_id', user.role_id);
                            this.formObj.append('old_photo_id', user.photo_id);

                            this.formObj.append('is_active', user.is_active);
                            this.formObj.append('_method', 'PATCH');
                         }
                        var token = {'api_token': this.$apiKey, 'user' : user.id};

                        console.log(this.formObj.get('old_photo_id'));
                        axios
                        .post(route('users.update', token), this.formObj)
                        .then(response=> {
                            console.log(response.data);
                            this.serverMessage=response.data;
                            });
                    },
                  getUsers(apiKey)
                  {
                        axios
                .get(route('users.index', apiKey ))
                .then(response=> {
                    console.log(response.data);
                    this.users=response.data;
                });
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
                      var token=this.$apiKey;
                       token = {api_token : token};
                          axios
                .get(route('getRoles', token))
                .then(response=> {
                    this.roles=response.data;

                });
                   }
                        },
       data: function(){
           return {
                api_key: this.$apiKey,
                 formObj: null,
                apiToken: [],
                users: [],
                roles:[],
                serverMessage:null
        }

       }
        ,
        beforeMount(){
            this.setViewData();
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
