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
                });

                    console.log('COMPONENT APP MOUNTED');

                }
    }
</script>
