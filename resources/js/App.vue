<template>
<div>
       <router-view> </router-view>

</div>
</template>

<script>

 import {route} from './routes.js';
    export default {
        props:['api_token', 'this_user_id'],
        data(){
            return {
                Theapi_key : this.api_token,
                Thethis_user_id: this.this_user_id
            }
        },
         beforeMount() {
Vue.prototype.$apiKey = this.Theapi_key;
            Vue.prototype.$this_user_id = this.Thethis_user_id;

                    console.log('COMPONENT APP MOUNTED');
  console.log('this user id');
            console.log(this.$this_user_id);
                }
    }
</script>
