<template>
    <div class="container-fluid">
    <div class="col-md-12"> <calendar :prop="prop"></calendar></div>


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
