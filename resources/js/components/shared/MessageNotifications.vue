<template>
 <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" @click="readNotifications" id="messagesDropdown" role="button"
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
                                    <router-link v-if="notification.type == 'messageCenter'" :to="'/admin/chat/' + notification.channelId" class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" :src="notification.userPhoto"
                                                alt="...">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">{{notification.messageContent}}</div>
                                            <div class="small text-gray-500">{{notification.firstName + " " + notification.lastName}} · 1d</div>
                                        </div>
                                    </router-link >
                                     <router-link v-if="notification.type == 'GroupMessageCenter'" :to="'/admin/chat/' + notification.group_id" class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">

                                            <img class="rounded-circle" :src="notification.groupPhoto"
                                                alt="...">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">{{notification.messageContent}}</div>
                                            <div class="small text-gray-500">{{notification.firstName + " " + notification.lastName}} · 1d</div>
                                        </div>
                                    </router-link >
                                </div>

                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>
</template>

<script>
import {route} from '../../routes.js';


    export default {
        data()
        {
            return {
                api_key : this.$apiKey,
                notifications: [],
                thisUserId:this.$this_user_id,
                newNotificationsNumber : []  ,
            }
        },
        methods:{
            readNotifications()
            {

                this.notifications.forEach(notification =>
                {
                    if(notification.isRead == null)
                    {

                    var token = this.$apiKey;
                    token= {api_token: token, notification_id : notification.from_id};
                    if(notification.type == "messageCenter"){

                    axios.get(route('readMessagesNotifications', token)).then(response =>
                        {

                           notification.isRead = response.data;
                           this.newNotificationsNumber = this.newNotificationsNumber - 1;
                        })
                            }
                    }
                })

                this.newNotificationsNumber = 0;
            },
            getNotifications()
            {
                let token= {api_token:  this.$apiKey, this_user_id: this.thisUserId};

                axios.get(route('getChatNotifications', token ))
                    .then(response =>
                        {

                            this.$set(this,"notifications", response.data);
                            console.log('Logs get Chat notifications: ');
                            console.log(response.data);

                        })
            },
            socket()
            {
                var id = this.thisUserId;
                let channel ="App.Models.User." + id;

                window.Echo.private(channel).notification( echoNotification =>
                {
                    if(echoNotification.type == "App\\Notifications\\MessageSended")
                    {
                        console.log(echoNotification);
                        let isNotificationInNotifications = false;
                        let i = 0;

                        if(this.notifications.length != 0)
                        {
                            this.newNotificationsNumber = 0;
                            console.log('notifications not working: ');
                            console.log(this.notifications);
                            while(isNotificationInNotifications == false && i <= this.notifications.length)
                            {
                                if(this.notifications[i].from_id == echoNotification.from_id && echoNotification.type == 'messageCenter')
                                {

                                    isNotificationInNotifications = true;
                                    this.notifications.shift(i);
                                    this.notifications.unshift(echoNotification)
                                    this.notifications.forEach(notification =>
                                    {

                                        if(notification.isRead == null){
                                            console.log('console log from socket')
                                            console.log(notification)
                                            this.newNotificationsNumber++;
                                        }
                                    })
                                    break;
                                }
                                i++;
                            }
                        }
                         if(isNotificationInNotifications == false)
                         {
                             this.notifications.unshift(echoNotification)
                             this.newNotificationsNumber++;

                         }
                    }else  if(echoNotification.type == "App\\Notifications\\GroupMessageSended")
                    {
                        console.log(echoNotification);
                        let isNotificationInNotifications = false;
                        let i = 0;

                        if(this.notifications.length != 0)
                        {
                            console.log('notifications not working: ');
                            console.log(this.notifications);
                            this.newNotificationsNumber = 0;
                            while(isNotificationInNotifications == false && i <= this.notifications.length)
                            {
                                console.log(notifications[i]);
                                if(this.notifications[i].type=="GroupMessageCenter"){

                                if(this.notifications[i].group_id == echoNotification.group_id && echoNotification.type == 'GroupMessageCenter')
                                {

                                    isNotificationInNotifications = true;
                                    this.notifications.shift(i);
                                    this.notifications.unshift(echoNotification)
                                    this.notifications.forEach(notification =>
                                    {

                                        if(notification.isRead == null){
                                            console.log('console log from socket')
                                            console.log(notification)
                                            this.newNotificationsNumber++;
                                                                     console.log('Socket notifications');
                             console.log(this.notifications);

                                        }
                                    })
                                    break;
                                }

                                }

                                i++;
                            }
                        }
                         if(isNotificationInNotifications == false)
                         {
                             this.notifications.unshift(echoNotification)
                             console.log('Socket notifications');
                             console.log(this.notifications);
                             this.newNotificationsNumber++;

                         }
                    }
                });
            }
        },

        async beforeMount(){

      await      this.getNotifications();
      await      this.socket();
        },
       mounted() {

            console.log('Component Notifications mounted.')
        }
    }
</script>
