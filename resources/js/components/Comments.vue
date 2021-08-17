<template>
    <div class="container">
    <table class="table">
    <thead>
        <th>ID</th>
        <th>Author</th>
        <th>Comment</th>
    </thead>
    <tbody>
        <tr v-for="comment in comments" :key= "comment.id">
            <td>{{comment.id}}</td>
            <td>{{comment.title}}</td>
            <td>{{comment.categories}}</td>
            <td>{{comment.body}}</td>
        </tr>
    </tbody>

</table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                comments: []
        }
            }
        ,
        mounted() {
            axios
                .get('http://localhost/b_appLaravel/public/api/Posts?api_token=jR1yWEDuIctMUHARQ4TRWsA4Tjg6vkinojsdwCr5hwOQv2BhksweeNY0tcdr')
                .then(response=> {this.comments=response.data;});
                console.log('initialized')
                setInterval(this.actualizar, 6000)

                },
        methods:{actualizar(){
             axios
                .get('http://localhost/b_appLaravel/public/api/Posts?api_token=jR1yWEDuIctMUHARQ4TRWsA4Tjg6vkinojsdwCr5hwOQv2BhksweeNY0tcdr')
                .then(response=> {this.comments=response.data;});
                console.log('interval')
                }},
                computed: {
                    lavoe: function(){
                        return 'hola'
                    }
                }
        }
    </script>
