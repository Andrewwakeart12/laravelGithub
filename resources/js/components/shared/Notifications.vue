<template>
<li class="nav-item dropdown no-arrow mx-1" @click="readNotifications">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter" v-if="this.newNotificationsNumber  > 0">{{this.newNotificationsNumber}}</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#" v-for="notification of this.unreadNotifications">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{notification.date}}</div>
                                        <span class="font-weight-bold">{{notification.deadline}}</span>

                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>

                            </div>
</li>
</template>

<script>

import {route} from '../../routes.js';
    export default {
        data(){
            return {
                api_key : this.$apiKey,
                unreadNotifications: [],
                thisUserId:[],
                newNotificationsNumber : []  ,
            }
        },
        methods:{
            readNotifications(){

                this.unreadNotifications.forEach(e =>{
                    var token = this.$apiKey;
                    token= {api_token: token, notifications : e.id_noty};
                    axios.get(route('readNotifications', token)).then(response =>{
                    console.log(response.data);
                })
                })

                this.newNotificationsNumber = 0;
            },
              getApiKey(){

                       axios
                .post(route('getApiKey'))
                .then(response=> {
                    Vue.prototype.$apiKey = response.data;
                    this.getUnreadNotifications();

            this.getThisUserId();
                });

                    },
            getTokenJson(){
                var token = this.$apiKey;
                token= {api_token: token};
                return token;
            },
            getUnreadNotifications(){
                var token = this.$apiKey;
                token= {api_token: token};

                axios.get(route('getUnreadNotifications', token )).then(response =>{

                    this.unreadNotifications = response.data;
                    console.log(response.data);
                    this.newNotificationsNumber = this.unreadNotifications.length;
                })
                 this.getTokenJson();
            },
            getThisUserId(){
             var token = this.$apiKey;
                token= {api_token: token};

                axios.get(route('thisUserId',token)).then(response =>{
                this.thisUserId = response.data;
                this.socket();
                console.log(response.data)
                })
            },
            socket(){
                var id = this.thisUserId;
                console.log("id: " + id)
                    let channel ="App.Models.User." + id;
                window.Echo.private(channel).notification( e =>{
                    this.unreadNotifications.push(e)
                                });
            }
        },

        beforeMount(){
            this.getApiKey();
        },
        mounted() {


            console.log('Component Notifications mounted.')
        }
    }
</script>
