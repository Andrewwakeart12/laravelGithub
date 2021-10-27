<template>
 <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter" v-if="this.newNotificationsNumber  > 0">{{this.newNotificationsNumber}}</span>
                            </a>
                            <!-- Dropdown - Messages -->


                               <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <div v-for="notification of this.notifications">
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" :src="notification.userPhoto"
                                                alt="...">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">{{notification.messageContent}}</div>
                                            <div class="small text-gray-500">{{notification.firstName + " " + notification.lastName}} · 1d</div>
                                        </div>
                                    </a>
                                </div>

                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>
</template>

<script>
import {route} from '../../routes.js';


    export default {
        data(){
            return {
                api_key : this.$apiKey,
                notifications: [],
                thisUserId:this.$this_user_id,
                newNotificationsNumber : []  ,
            }
        },
        methods:{
            readNotifications(){

                this.notifications.forEach(e =>{
                    if(e.isRead == null){

                    var token = this.$apiKey;
                    token= {api_token: token, notifications : e.id_noty};
                    axios.get(route('readNotifications', token)).then(response =>{
                    console.log(response.data);
                })
                    }
                })

                this.newNotificationsNumber = 0;
            },
              getApiKey(){

                       axios
                .post(route('getApiKey'))
                .then(response=> {
                    Vue.prototype.$apiKey = response.data;
                    this.getNotifications();
                    this.getThisUserId();
                });

                    },
            getTokenJson(){
                var token = this.$apiKey;
                token= {api_token: token};
                return token;
            },
            getNotifications(){
                var token = this.$apiKey;
                token= {api_token: token, this_user_id: this.thisUserId};

                axios.get(route('getChatNotifications', token )).then(response =>{

                    this.$set(this,"notifications", response.data);
                    console.log('Logs get Chat notifications: ');
                    console.log(response.data);

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
                    console.log(e);
                    if(e.type == "messageCenter"){

                    this.notifications.push(e)
                    this.newNotificationsNumber++;
                    console.log(this.notifications);

                    }
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
