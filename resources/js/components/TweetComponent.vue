<template>
    <div class="tweet">
        {{ tweet.tweet }}
        <br />
        by -{{tweet.id}} @ {{ tweet.created_at }}
        <br/>
        <button :class="{'displaying': likeActive}" class="btn btn-sm likeUnlikeBtn" @click="likeTweet(tweet.id)" style="background-color:#1da1f2; color:white;"><i class="fa fa-heart" style="color:#2DB2F4;"></i>Like</button> &nbsp;&nbsp;
        <button :class="{'displaying': unlikeActive}" class="btn btn-sm likeUnlikeBtn" @click="unlikeTweet(tweet.id)" style="background-color: #1da1f2; color:white;"><i class="fa fa-heart"></i>unlike</button>

        <textarea v-model="newComment" class="form-control" name="comment" placeholder="Comment Here"></textarea>

        <input type="hidden" name="tweet_id" value="tweet_id"/>

        <div class="align-right">
            <button @click="makeComment" class="btn btn-success">Comment</button>
        </div>
        <comments-component :tweetId="tweet.id"></comments-component>
        <br />
        <commenting-component :tweetId="tweet.id"></commenting-component>

    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Tweet Component mounted.')
    },
    data() {
        return{
            likeActive: true,
            unlikeActive: false,
            newComment: "",
            comment: []
      }
    },
    methods:{
        makeComment(){
        // alert(this.tweet.id);
        console.log(this.tweet);
        axios.post('/api/new-comment',{
            tweet_id: this.tweet.id,
            user_id: currentlyLoggedInUserInUserId,
            comment: this.newComment
        })

        // alert(this.newComment);

        .then(function (response) {
            // console.log(response);
        })
        .catch(function (error){
            // console.log(error);
        });
      location.reload();
    },
        likeTweet(tweetId){
            this.likeActive  = false;
            this.unlikeActive  = true;
            axios.post('/api/tweet-likes',{
                tweet_id: tweetId,
                like: "1",
                user_id: currentlyLoggedInUserInUserId
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        unlikeTweet(tweetId){
            this.likeActive  = true;
            this.unlikeActive  = false;
            axios.post('/api/tweet-likes',{
                tweet_id: tweetId,
                like: "0",
                user_id: currentlyLoggedInUserInUserId
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error){
                console.log(error);
            });
        }
    },
    props:['tweet']
}
</script>
