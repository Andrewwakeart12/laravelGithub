<template>
<div class="container">
 <h1> holas </h1>
{{apiKey}}
</div>
</template>

<script>
    export default {
          props:[
         'apiKey'
        ],
       data() {
            return {
                api_key: props.apiKey,

        }
            },
        mounted() {
            console.log(this.props.apiKey)
        }
    }
</script>
