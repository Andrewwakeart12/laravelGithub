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
                                <div class="chat-search-box">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                            <div class="selected-user">
                                <span>To: <span class="name">Emily Russell</span></span>
                            </div>
                            <div class="chat-container">
                                <ul class="chat-box chatContainerScroll">
                                 <li class="chat-right">
                                        <div class="chat-hour">08:59 <span class="fa fa-check-circle"></span></div>
                                        <div class="chat-text">Well I am not sure.
                                            <br>I have results to show you.</div>
                                        <div class="chat-avatar">
                                            <img src="/img/undraw_profile_3.svg" alt="Retail Admin">
                                            <div class="chat-name">Joyse</div>
                                        </div>
                                    </li>
                                    <li class="chat-left">
                                        <div class="chat-avatar">
                                            <img src="/img/undraw_profile_3.svg" alt="Retail Admin">
                                            <div class="chat-name">Russell</div>
                                        </div>
                                        <div class="chat-text">The rest of the team is not here yet.
                                            <br>Maybe in an hour or so?</div>
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
                message:[]
            }
        },
        methods: {
            async selectUser(e)
            {
                this.chatUsers.forEach(el =>
                {
                    if(el.selected)
                    {
                       try
                       {
                        let id = this.channelSelected;
                        let channel =`chat.` + id;
                        window.Echo.leaveChannel(channel);
                        console.log("leaving");
                       } catch(e)
                       {
                       console.error(e);
                       }
                        el.selected=false;
                    }
                     else if(el.id == e.id && el.selected == false){
                        console.log(e);
                        el.selected=true;


                         this.socket(el.channelId);
                    }
                })
            },
             autoSelectChat()
            {


                console.log('Chat Users: ');
                console.log(this.chatUsers[0].channelId);
                this.$set(this.chatUsers[0], 'selected', true);
                 this.socket(this.chatUsers[0].channelId);
                 this.channelSelected= this.chatUsers[0].channelId;

            },
            sendMessage()
            {
                let msg = this.message;
                console.log(msg);
                let conversationId = 1;
                axios.post(route('sendMessage', {api_token : this.$apiKey, message: msg, conversationId : this.channelSelected})).then(response=>{
                    console.log(response.data);
                })
                this.message= null;
            },
           async getChatUsers()
           {

                let response = await axios.get(route('getUsersChats', {api_token : this.$apiKey}));

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

              socket(channelId){
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
            }
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
