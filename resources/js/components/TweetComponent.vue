<template>
    <div class="tweet">
        {{ tweet.tweet }}
        <br />
        by -{{tweet.user_id}} @ {{ tweet.created_at }}
        <br/>
        <button :class="{'displaying': likeActive}" class="btn btn-sm likeUnlikeBtn" @click="likeTweet(tweet.id)" style="background-color: #1da1f2; color:white;"></i>Like</button> &nbsp;&nbsp;
        <button :class="{'displaying': unlikeActive}" class="btn btn-sm likeUnlikeBtn" @click="unlikeTweet(tweet.id)" style="background-color: #1da1f2; color:white;"></i>Unlike</button>
        <input type="hidden" name="_method" value="DELETE"/>
        <input type="hidden" name="tweet_id" value=""/>
        <button @click="deleteTweet" type="submit" class="btn btn-default like btn-delete" ng-click="like()" style="background-color: #1da1f2; color:white;">Delete</button>


        <textarea v-model="newComment" class="form-control" name="comment" placeholder="Comment Here"></textarea>
        <input type="hidden" name="tweet_id"/>
        <button @click="makeComment" class="btn btn-success">Comment</button>



    </div>

</template>

<script>
export default {
    mounted() {
        console.log('Tweet Component mounted.')
    },
    data() {

        return{
            tweets: [],
            newComment:'',

            likeActive: true,
            unlikeActive: false
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
        deleteTweet(){
            alert('Are you sure you want to perform this action?');
            console.log(this.deleteTweet);
            axios.post('/api/tweet-delete',{
                tweet_id: this.tweet.id,
                user_id: currentlyLoggedInUserInUserId,
                comment: this.newComment
        })

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
