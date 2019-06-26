<template>
    <div>
        <button :class="{'displayingfollow': unFollowActive}" class="btn btn-xs  followUnFollowBtn" @click="unFollow()"  style="background-color: #1da1f2; color:white; font-size:10px;">Unfollow</button>
        <button :class="{'displayingfollow': followActive}" class="btn btn-xs  followUnFollowBtn" @click="follow()"  style="background-color: #1da1f2; color:white; font-size:10px;">Follow</button>
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('FollowComponent mounted.')


        },
        data(){
            return{

                followActive: true,
                unFollowActive: false,

            }
        },
        methods: {

        follow(){
            this.followActive = false;
            this.unFollowActive = true;
            axios.post('/api/users-follow',{
                follows_id: "",
                following: "1",
                user_id: currentLoggedInUserUserId
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
            location.reload();
        },
        unFollow(){
            this.followActive = true;
            this.unFollowActive = false;
            axios.post('/api/users-follow',{
                follows_id: "",
                following: "0",
                user_id: currentLoggedInUserUserId
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error){
                console.log(error);
            });
            location.reload();
        }
    },
        props: ['tweetId']
}
</script>
