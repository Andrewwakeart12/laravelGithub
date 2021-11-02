<template>
  <div>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top  border border-top-0">

        <ul class="navbar-nav mr-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->


            <!-- Nav Item - Alerts -->

            <!-- Nav Item - Messages -->





            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <img class="img-profile rounded-circle" :src="this.participant.profilePhoto">
                <span class="mr-2 ml-2 d-none d-lg-inline name">{{this.participant.username}} </span>
                <span class="time ml-2">({{this.participant.firstName + " " + this.participant.lastName}})</span>
                </a>
                <!-- Dropdown - User Information -->

            </li>

        <div class="topbar-divider d-none d-sm-block"></div>
    </ul>
    <ul class="navbar-nav ml-auto mt-4 mr-2">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle optionButtons " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="d-sm-inline-block  optionButtons">...</span>
            </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in mt-0" aria-labelledby="userDropdown">
                        <div class="dropdown-item" @click="groupCreationMenu()">
                            <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                            Create Group
                        </div>
                    </div>
        </li>

    </ul>
    </nav>
   <b-modal v-model="modalShow">

         <label for="title">Name</label>
        <b-form-input class="form-group h3" type="text" v-model="group.groupName" placeholdre="title"/>
                    <input name="file" type="file" class="userInputInTable" v-on:change="insertedFile">
<template #modal-footer="{guardar,cancel}">
     <b-button size="sm" variant="success" @click="createGroupChat()">Create</b-button>
   </template>
    </b-modal>

</div>
</template>

<script>
import {route} from '../../routes.js';

    export default {
        props:['participant'],
        data(){
            return{
                modalShow:false,
                group:[],
                formObj: [],
                usersAvaibleForGroups: [],
            }
        },
        methods : {

                insertedFile(file){
                     if(file){
                        this.formObj = new FormData()
                        this.formObj.append('group_photo_id', file.srcElement.files.item(0));
                        console.log('Log from form object set')
                        console.log(this.formObj.get('group_photo_id'));
                        return 0;
                    }
                },
            getAvaibleUsersForGroups(){
                axios.get(route('getAvaibleUsersForGroups',{api_token: this.$apiKey, thisUserId : this.$this_user_id})).then(response =>{
                    console.log('Log getAvaibleUsersForGroups:');
                    this.usersAvaibleForGroups = response.data;
                })
            },
            createGroupChat(){
                if(this.formObj != null){
                    this.formObj.append('groupName',this.group.groupName)
                }else{
                    this.formObj = new FormData();
                    this.formObj.append('groupName',this.group.groupName)
                }
                axios.post(route('createGroupChat',{api_token: this.$apiKey}),this.formObj).then(response=>{
                    console.log('Log from group chat');
                    console.log(response.data);
                })
            },
            async groupCreationMenu(){
                await this.getAvaibleUsersForGroups();
                this.modalShow= true;
            }

        },
        mounted() {
            console.log('Component ChatOptions App mounted.')
        }
    }
</script>
