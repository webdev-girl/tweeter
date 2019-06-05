<template>

    <div class="comment" style="font-size: 20px; color:#3B3B54; font-weight:bold; font-style: italic; text-align:right;">
        <div class="comment-component" >

            <!-- {{ this.comments }} -->

            <comment-component v-for="comment in comments" :comments="comment"> </comment-component>

        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.initialComments();
        console.log('Comments Component mounted.')
    },
    data() {
        return{
            comments: [],
        }
    },
    methods:{
        initialComments(){
            axios.get("/api/tweet-comments/" + this.tweetId)
            .then((response) => {
                this.comments = response.data.data;
            });
        }
    },
    props:['tweetId']
}
</script>
