<template>
<div class="container-fluid row">
    <div class="col-md-7"><createUser></createUser></div>
    <div class="col-md-5">
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
                api_key: this.getApiKey()

        }
            }
        ,
        mounted() {
                    console.log('COMPONENT ADMIN MOUNTED');
                    this.getApiKey();
                },

    }
</script>
