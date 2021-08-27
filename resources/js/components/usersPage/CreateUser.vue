<template>
<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Creat a user!</h1>
                            </div>
                            <form class="user">

                                 <div class="form-group">
                                    <input type="text" class="form-control form-control-user " id="exampleInputEmail"
                                        placeholder="Username" name='username' v-model="user.username"  required autocomplete="username">


                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" name="firstName"
                                            v-model="user.firstName" placeholder="First Name"  required autocomplete="firstName">

                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user " id="exampleLastName"
                                            placeholder="Last Name" required autocomplete="lastName" v-model="user.lastName" name='lastName'>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" name='email' v-model="user.email" required autocomplete="email">

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user "
                                            id="exampleInputPassword" placeholder="Password" v-model="user.password" required autocomplete="new-password">

                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password_confirmation" class="form-control form-control-user"
                                            id="exampleRepeatPassword" v-model="user.password_confirmation" placeholder="Repeat Password" required autocomplete="new-password">

                                    </div>
                                </div>
                                <input @click="createUser()"class="btn btn-primary btn-user btn-block" value="Create">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



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

                  var token = this.getTokenJson(this.api_key);
                     axios
                .post(route('users.store', token), this.user)
                .then(response=> { console.log(this.user) }

                )}

            },

        data(){
            return {
                api_key: this.getApiKey(),
                user: {},
            }
        },
        mounted() {
            console.log('Component Exaple App mounted.')
        }
    }
</script>
