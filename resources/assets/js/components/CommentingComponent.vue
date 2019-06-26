<!-- },
    methods: {
        fetchGifs: function() {
          const url = `${this.apiUrl}?q=${this.query}&api_key=${this.apiKey}&limit=8`;
          axios.get(url)
            .then((response) => {
                console.log(response)
                this.gifs = response.data.data;
                this.dropdownOpen = true;
            })
        },
        selectGif(gif) {
            console.log(gif);
            this.selectedGif = gif.fixed_height.url;
            this.dropdownOpen = false;
        },
    },
} -->
<template>
    <div class="container">

        <textarea v-model="newComment" class="form-control" name="comment" placeholder="Comment Here"></textarea>

            <input type="hidden" name="user_id" value="currentLoggedInUserUserId" />

            <div class="align-right">
                <button @click="makeComment" class="btn btn-success">Comment</button>
            </div>
            <br/>

            <button :class="{'displayingfollow': followActive}" class="btn btn-xs  likeUnFollowBtn" @click="follow()"  style="background-color: #1da1f2; color:white; font-size:10px;">Follow</button> &nbsp;&nbsp;
            <button :class="{'displayingfollow': unFollowActive}" class="btn btn-xs  likeUnFollowBtn" @click="unFollow()"  style="background-color: #1da1f2; color:white; font-size:10px;">Unfollow</button>
    </div>
</template>

<script>

    export default {
        mounted() {
            console.log('Commenting Component mounted.')
        },
        data(){
            return{
                followActive: true,
                unFollowActive: false,
                newComment: "",
            }
        },
        methods: {
            makeComment(){
                axios.post("/api/new-comment", {
                    tweet_id: this.tweetId,
                    user_id: currentLoggedInUserUserId,
                    comment: this.newComment,
                })
                .then(function(response) {
                })
                .catch(function(error) {
                });
            location.reload();
            },

        follow(){
            this.followActive = false;
            this.unFollowActive = true;
            axios.post('/api/follow-user',{
                follower_id: this.tweetId,
                following: "1",
                user_id: currentLoggedInUserUserId
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        unFollow(){
            this.followActive = true;
            this.unFollowActive = false;
            axios.post('/api/follow-user',{
                follower_id: this.tweetId,
                unfollow: "0",
                user_id: currentLoggedInUserUserId
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error){
                console.log(error);
            });
        }
    },
        props: ['tweetId']
}
</script>
