<template>
    <div class="container-fluid">
        <h1>Posts</h1>
         <article data-editable v-for="post of posts">
            <div class ="card">
                <textarea id="mytextarea"></textarea>

            </div>

         </article>
        <editor api-key="no-api-key" :init="{
            height:500,
            plugins:['advlist autolink lists link image charmap print preview anchor',
            'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor|\
            alignleft aligncenter alignright alignjustify |\
            bullist nulist outdent indent | removeformat | help'
        }"/>
    </div>
</template>

<script>

import {route} from '../../routes.js';
import Editor from '@tinymce/tinymce-vue';
    export default {
         components:{
             'editor' : Editor
         },
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
