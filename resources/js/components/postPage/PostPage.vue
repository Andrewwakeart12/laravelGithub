<template>
    <div class="container-fluid">
        <h1>Posts</h1>
         <article data-editable v-for="post of posts">
            <div class ="card">
            <div v-html="post.body"></div>

            </div>

         </article>
         <chat></chat>
    </div>
</template>

<script>


import {route} from '../../routes.js';
    export default {
                    methods:
            {
            getPosts(){
                var token = this.getTokenJson(this.$apiKey);
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
                posts:[],

        }
            },
             beforeMount(){
            this.getPosts();
        },
        mounted() {
            console.log('Component Posts  mounted.')
        }
    }
</script>
