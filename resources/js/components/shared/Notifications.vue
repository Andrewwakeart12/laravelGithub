<template>
<li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#" v-for="notification of this.unreadNotifications[0]">
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
                unreadNotifications: []
            }
        },
        methods:{
              getApiKey(){

                       axios
                .post(route('getApiKey'))
                .then(response=> {
                    Vue.prototype.$apiKey = response.data;
                    this.getUnreadNotifications();

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
                    console.log(response);
                })
                 this.getTokenJson();
            }
        },
        beforeMount(){
        },
        mounted() {
            this.getApiKey();
            console.log('Component Notifications mounted.')
        }
    }
</script>
