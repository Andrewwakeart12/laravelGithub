<template>
    <div class="container-fluid">
        <h1>Posts</h1>
         <article data-editable v-for="post of posts">
            <div class ="card">
            <div v-html="post.body"></div>

            </div>

         </article>
        {{this.api_key}}
    </div>
</template>

<script>


import {route} from '../../routes.js';
    export default {
                    methods:
            {
            getApiKey()
            {
                        axios
                .post(route('getApiKey'))
                .then(response=> {
                    this.api_key = response.data;
                    var token = this.getTokenJson(this.api_key);
                    this.getPosts(token);
                 });

                    },
            getPosts(token){
                     axios
                .get(route('Posts.index',token))
                .then(response=> {
                    this.posts = response.data;
                 });
            },
            getTokenJson(apiKey){

                    var token = apiKey;
                    console.log('token : ' + token);
                    return {api_token : token};
                },
            },
            data() {

            return {
                api_key: [],
                posts:[],

        }
            },
             beforeMount(){
            this.getApiKey();
        },
        mounted() {
            console.log('Component Exaple App mounted.')
        }
    }
</script>
