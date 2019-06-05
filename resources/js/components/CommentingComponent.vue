
<template>
<div class="container">
    <form name="comments-form" method="post" action="tweets">

        <textarea v-model="newComment" class="form-control" name="comment" placeholder="Comment Here"></textarea>

        <input type="hidden" name="user_id" value="currentlyLoggedInUserInUserId" />

        <div class="align-right">
            <button @click="makeComment" class="btn btn-success">Comment</button>
        </div>
        <div class="container fluid">
            <div class="layout row wrap justify-center">
                <div class="card pa-2">
                    <div class="card-media" :src="gifSrc" height="200px"></div>
                </div>
            </div>
        </div>

    </form>
</div>
</template>

<script>
export default {
    mounted() {
    },
    data(){
        return{
            newComment: "",
            apiKey: 'IY8gHfjUnnCD9ONKb93c9ev0K0gPyJTk',
            limit: 4,
            search: '',
            gif: [],
            gifSrc: '',
            valid: '',
        }
    },
    methods: {
        makeComment(){
            axios.post("/api/new-comment", {
                tweet_id: this.tweetId,
                user_id: currentlyLoggedInUserInUserId,
                comment: this.newComment,
            })
            .then(function(response) {
            })
            .catch(function(error) {
            });
            console.log(tweetId)
        },
        getGif(){
alert();
            return axios("https://api.giphy.com/v1/gifs/search?q=" + this.search + "&api_key=doN7pilpkc58wRLVJiriZQkes6IAYz4k&q=hello&limit=20&offset=0&rating=G&lang=en", {
            method: 'GET',
            mode: 'no-cors',
            headers: {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json',
                },
            })
            // axios.get("https://api.giphy.com/v1/gifs/search?q=" + this.search + "api_key=doN7pilpkc58wRLVJiriZQkes6IAYz4k&q=hello&limit=20&offset=0&rating=G&lang=en")
            // .then((response) => {
            //     console.log(response);
            //     this.gif.splice(0,this.gif.length);
            //
            //     (response.data.data).forEach(function(element) {
            //         //this.gif.push( element.images.fixed_height.url);
            //     });
            // });
            // axios.get('https://api.giphy.com/v1/gifs/search?q=' + this.search + '&api_key=' + this.apiKey + '&limit=' + this.limit)
            //     .then((response) => {
            //
            //         console.log(response.data.data[0].images.fixed_height.url)
            //
            //         this.gif = response.data[0];
            //
            //         this.gifSrc = response.data.data[0].images.fixed_height.url;
            //
            //     })
            //     .catch(function(error){
            //         console.log(error);
            //     })
        }
    },
    props: ['tweetId']
}
</script>
<!-- <template>
    <div>
        <h2 class="title">Search</h2>
        <input type="hidden" name="giph_search" v-model="selectedGif">
        <input type="hidden" name="gif_comment" :value="(selectedGif ? 1 : 0)">
       <input type="text" class="input-group-append" name="query" v-model="query" @keyup="fetchGifs">

       <div class="columns is-multiline" v-if="dropdownOpen">
         <div class="column is-one-quarter" v-for="gif in gifs">
           <div class="gif-box">
             <a href="#" @click.prevent="selectGif(gif.images)">
               <img class="gif-image" :src="gif.images.fixed_width.url">
             </a>
           </div>
         </div>

       </div>
       <div v-show="selectedGif" class="card selectedGifPreview">
           <div class="card-body">
               <img :src="selectedGif" />
               <a href="#" class="btn btn-sm btn-danger" @click="selectedGif=''">x</a>
           </div>
       </div>
     </div>
</template>

<script>
export default {
    data(){
        return{
            query: null,
            apiKey: 'tZTbkZkpbZhyDnHqQR5zzMAPF9bnQ27x',
            gifs: [],
            selectedGif: null,
            apiUrl:'https://api.giphy.com/v1/gifs/search',
            dropdownOpen: false,
            }
    },
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
}
</script> -->
