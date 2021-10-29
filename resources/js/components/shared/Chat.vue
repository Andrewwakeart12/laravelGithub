<template>
<div class="container">

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row gutters">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="card m-0">

                    <!-- Row start -->
                    <div class="row no-gutters">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                            <div class="users-container">

                                <ul class="users" v-for="user of this.chatUsers">
                                  <li class="person" @click="selectUser(user)" :class="[user.selected ? 'chatSelected' : 'not_selected']">
                                        <div class="user">
                                            <img :src="user.profilePhoto" alt="Retail Admin">
                                            <span class="status busy"></span>
                                        </div>
                                        <p class="name-time">
                                            <span class="name">{{user.username}} </span>
                                            <span class="time">({{user.firstName + " " + user.lastName}})</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">

                            <div class="chat-container">
                                <ul class="chat-box chatContainerScroll" v-for="message in this.messagesInChat">
                                     <li v-if="message.user_id != thisUserData.id" class="chat-right">
                                            <div class="chat-hour">08:59 <span class="fa fa-check-circle"></span></div>
                                            <div class="chat-text">{{message.text}}</div>
                                            <div class="chat-avatar">
                                                <img :src="participant2.profilePhoto" alt="Retail Admin">
                                                <div class="chat-name">{{participant2.username}}</div>
                                            </div>
                                    </li>
                                    <li v-if="message.user_id === thisUserData.id" class="chat-left">
                                        <div class="chat-avatar">
                                            <img :src="thisUserData.profilePhoto" alt="Retail Admin">
                                            <div class="chat-name">{{thisUserData.username}}</div>
                                        </div>
                                        <div class="chat-text">{{message.text}}</div>
                                        <div class="chat-hour">08:57 <span class="fa fa-check-circle"></span></div>
                                    </li>                               </ul>
                                <div class="form-group mt-3 mb-0">
                                    <textarea v-model="message" @keyup.enter="sendMessage"class="form-control" rows="3" placeholder="Type your message here..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>

            </div>

        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->

</div>
</template>
<script>
 import {route} from '../../routes.js';

    export default {
        data(){
            return {
                chatUsers : [],
                thisUserData: [],
                thisUserId : this.$this_user_id,
                channelId:[],
                channelSelected : [],
                message:[],
                participant1: [],
                participant2: [],
                messagesInChat:[],
            }
        },
        methods: {
            async selectUser(e)
            {
                //e is the user send by the click event
                this.chatUsers.forEach(user =>
                {
                    if(user.selected)
                    {
                        let id = user.channelId;
                        let channel =`chat.${id}`;
                        window.Echo.leave(channel);
                        console.log(`leaving ${channel}`);

                        user.selected=false;
                    }
                     else if(user.id == e.id && user.selected == false){
                        console.log(`Event info in the internal selectUserFunction id: ${e.id}, channelId: ${e.channelId}`);
                        user.selected=true;
                        this.$set(this,'messagesInChat', null);

                        this.channelSelected = e.channelId;
                        this.participant2 = user;
                        this.getMessagesInChat(user.channelId);

                         this.connectWithChat(user.channelId);
                    }
                })
            },
             autoSelectChat()
            {


                this.$set(this.chatUsers[0], 'selected', true);
                this.participant1 = this.thisUserData;
                this.participant2 = this.chatUsers[0];
                console.log('parcipants: ');
                console.log(this.participant1);
                console.log(this.participant2);
                this.connectWithChat(this.chatUsers[0].channelId);
                this.getMessagesInChat(this.chatUsers[0].channelId);
                this.channelSelected= this.chatUsers[0].channelId;
                this.getChatMessages();

            },
            async sendMessage()
            {
                let msg = this.message;
                console.log(msg);
                let conversationId = this.channelSelected;
                let thisUserId = this.thisUserId;
                let toUser = this.participant2;
                let response = await axios.post(route('sendMessage', {api_token : this.$apiKey, message: msg, conversationId : this.channelSelected, thisUserId : thisUserId, toUser: this.participant2.id}));
                if(response.data.emptyMesssage != true){
                    this.$set(this.messagesInChat, this.messagesInChat.length, response.data);
                     console.log('log from send message function');

                     console.log(this.messagesInChat);
                }else {
                    console.log("ThisUserId sended:");
                    console.log(thisUserId);

                    console.log("toUser sended:");
                    console.log(toUser);

                    console.log("response received in sended:");
                    console.log(response.data);
                }


                    this.message= null;
            },
           async getChatUsers()
           {

                let response = await axios.get(route('getUsersChats', {api_token : this.$apiKey, thisUserId: this.thisUserId}));

                response.data.forEach(user =>{

                        if(user.id != this.thisUserId){

                            this.chatUsers.push(user);
                            console.log('OtherUsers');
                            this.$set(user, 'selected', false);
                            console.log(user);
                        }else{
                            console.log('thisUser');
                            console.log(user);
                            this.thisUserData = user;
                        }

                    });
                    await this.autoSelectChat()
            },

              connectWithChat(channelId){
                var id = channelId;

                console.log("idv: " + id)
                    let channel =`chat.` + id;
                    console.log(channel);
                window.Echo.join(channel).here((users)=>{
                    console.log(users);
                }).joining((user)=>{
                    console.log(user);
                } ).leaving((user)=>{
                    console.log(user);
                } ).error((error)=>{
                    console.error(error);
                })
            },
            getChatMessages(){
                     var id = this.thisUserId;
                     let channel ="App.Models.User." + id;
                window.Echo.private(channel).notification( e =>{

                    if(e.type == "App\\Notifications\\MessageSended"){
                        console.log(e);

                    if(this.participant2.id == e.from_id){
                        e.text = e.messageContent;
                        e.text = e.messageContent;
                        this.messagesInChat.push(e);

                    }
                        }
                    console.log(this.messagesInChat);
                    });
            },
                 async getMessagesInChat(conversationId)
                 {
                     axios.post(route('getMessagesInChat',{api_token : this.$apiKey, conversationId: conversationId})).then(response=>{
                        console.log(conversationId);
                         this.$set(this,'messagesInChat', response.data)
                         console.log('log from getMessages function');
                         console.log(response.data)
                     })
                 },
        },
         async beforeMount() {
             try{
               await this.getChatUsers();
            }catch(e){
                console.error(e);
            }
        },
         mounted() {


            console.log('Component Chat App mounted.')
            console.log('this user id');
            console.log(this.$this_user_id);
        }
    }
</script>
