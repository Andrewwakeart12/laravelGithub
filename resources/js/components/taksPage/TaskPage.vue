<template>
    <div class="container-fluid">
        <h1> Tasks </h1>
        <div class="row">
        <div class="col-md-6"> <h3>Task Creator here</h3></div>
    <div class="col-md-6"> <calendar :prop="prop"></calendar></div>


    </div>

    </div>
</template>

<script>
import {route} from '../../routes.js';

    export default {
        data(){
            return {
                api_key:this.$apiKey,
                prop:[]
            }
        },
        beforeCreate(){
            console.log(this.api_key);
        },
        mounted() {
            console.log('Component Exaple App mounted.' + ' ' + this.$apiKey)
        }
    }
</script>
