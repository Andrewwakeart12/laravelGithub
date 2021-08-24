<template>
<div class="container-fluid row">
<h1>Roles page</h1>
    {{this.roles}}
</div>


</template>

<script>
import {route} from '../../routes.js';
    export default {

            methods:{
            getApiKey(){
                        axios
                .post(route('getApiToken'))
                .then(response=> {this.api_key=response.data;
                console.log(response.data);
                });
                    },
            getRoles(){
                axios
                .get(route('options'))
                .then(response=> {this.roles=response.data;
                console.log(response.data);});
            }
        },
       data() {

            return {
                api_key: [],
                roles :this.getRoles(),

        }
            }
        ,
        mounted() {
                    console.log('COMPONENT ADMIN MOUNTED');
                    this.getApiKey();
                    this.getRoles();
                },

    }
</script>
