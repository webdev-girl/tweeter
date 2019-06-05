<template>

    <div class="comment" style="font-size: 20px; color:#3B3B54; font-weight:bold; font-style: italic; text-align:right;">

    
      <ul>
          <comment v-for="comment in comments" :comment="comments"></comment>
      </ul>

    </div>
</template>

<script>
export default {
    mounted() {
        this.initialComments();
        console.log('Component mounted.')
    },
    data() {
        return{
            comments: [],


        }
    },
    methods:{
        initialComments(){
            axios.get('/api/tweet-comments/' + this.tweetId)
            .then((response) => {
                this.comments = response.data.data;
            });
        }
    },
    props:['comment']
}
</script>
