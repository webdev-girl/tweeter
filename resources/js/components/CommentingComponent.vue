<template>
    <div class="container">
        <!-- <form name="comments-form" method="post" action="home"> -->

            <div class="container fluid">
                <div class="layout row wrap justify-center">
                    <div class="card pa-2">
                        <div class="card-media" :src="gifSrc" height="200px"></div>
                    </div>
                </div>
            </div>

        <!-- </form> -->
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        data(){
            return{
                
                apiKey: 'IY8gHfjUnnCD9ONKb93c9ev0K0gPyJTk',
                limit: 4,
                search: '',
                gif: [],
                gifSrc: '',
                valid: ''
            }
        },
        methods: {
            // makeComment(){
            //     axios.get('/api/new-comment', {
            //         tweet_id: this.tweetId,
            //         user_id: currentlyLoggedInUserInUserId,
            //         comment: this.newComment
            //     })
            //     .then(function(response) {
            //     })
            //     .catch(function(error) {
            //     });
            //     console.log(tweetId)
            // },
            getGif(){
alert();
                // return axios("https://api.giphy.com/v1/gifs/search?q=" + this.search + "&api_key=doN7pilpkc58wRLVJiriZQkes6IAYz4k&q=hello&limit=20&offset=0&rating=G&lang=en", {
                // method: 'GET',
                // mode: 'no-cors',
                // headers: {
                // 'Access-Control-Allow-Origin': '*',
                // 'Content-Type': 'application/json',
                //     },
                // })
                // axios.get("https://api.giphy.com/v1/gifs/search?q=" + this.search + "api_key=doN7pilpkc58wRLVJiriZQkes6IAYz4k&q=hello&limit=20&offset=0&rating=G&lang=en")
                // .then((response) => {
                //     console.log(response);
                //     this.gif.splice(0,this.gif.length);
                //
                //     (response.data.data).forEach(function(element) {
                //         //this.gif.push( element.images.fixed_height.url);
                //     });
                // });
                axios.get('https://api.giphy.com/v1/gifs/search?q=' + this.search + '&api_key=' + this.apiKey + '&limit=' + this.limit)
                    .then((response) => {
                        console.log(response.data.data[0].images.fixed_height.url);
                        this.gif = response.data[0];
                        this.gifSrc = response.data.data[0].images.fixed_height.url;
                    })
                    .catch(function(error){
                        console.log(error);
                    })
            }
        },
        props: ['tweetId']
    }
</script>
