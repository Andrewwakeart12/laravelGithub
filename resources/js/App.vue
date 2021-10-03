<template>
<div>
       <router-view> </router-view>
</div>
</template>

<script>
 import {route} from './routes.js';
    export default {
        props:['api_token'],
         mounted() {
                axios
                .post(route('getApiKey'))
                .then(response=> {
                    Vue.prototype.$apiKey = response.data;
                    this.api_key=response.data;
                    this.PostIndex = route('Posts.index', this.getTokenJson(this.api_key));
                    console.log('apiKey "global : "' + ' ' + this.$apiKey);
                });
                    console.log('COMPONENT APP MOUNTED');

                }
    }
</script>
