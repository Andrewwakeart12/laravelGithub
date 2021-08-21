<template>
<div class="container-fluid">
    <createUser></createUser>
    <displayUsers v-bind:apiKey="api_key"></displayUsers>
</div>


</template>

<script>
    export default {
            methods:{
            getApiKey(){
                        axios
                .post('http://localhost:8000/getApiKey')
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
