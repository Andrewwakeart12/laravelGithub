<template>
<div class="container-fluid row">
    <div><createUser></createUser></div>
    <div class="responsive">
    <displayUsers v-bind:apiKey="api_key"></displayUsers>
    </div>
</div>


</template>

<script>
import {route} from '../../routes.js';
    export default {

            methods:{
            getApiKey(){
                        axios
                .post(route('getApiToken'))
                .then(response=> {this.api_key=response.data;});
                    }
        },
       data() {

            return {
                api_key: this.getApiKey(),
                userDeleteRoute:[]

        }
            }
        ,
        mounted() {
                    console.log('COMPONENT ADMIN MOUNTED');
                    this.getApiKey();
                },

    }
</script>
