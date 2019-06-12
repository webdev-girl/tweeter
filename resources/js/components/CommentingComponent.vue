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

            <!-- <input type="hidden" name="user_id" value="currentLoggedInUserUserId" /> -->

            <div class="align-right">
                <button @click="makeComment" class="btn btn-success">Comment</button>
            </div>
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

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('CommentingComponent mounted.')
        },
        data(){
            return{
                newComment: "",
                query: null,
                apiKey: 'tZTbkZkpbZhyDnHqQR5zzMAPF9bnQ27x',
                gifs: [],
                selectedGif: null,
                apiUrl:'https://api.giphy.com/v1/gifs/search',
                dropdownOpen: false
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

// alert();
            doSearch() {
                // if no search criteria is entered, cancel the function
                if(!this.criteria){
                     return false;
                }

                // clear gifs list and close dropdown menu when a new search is entered
                this.gifs = [];
                this.dropdownOpen = false;

                // use axios to make our AJAX call to the Giphy API Search Endpoint
                // paramaters: search query, api key, and result limit
                axios.get('http://api.giphy.com/v1/gifs/search?q=' + this.criteria + '&api_key=' + this.apiKey + '&limit=' + this.limit)
                    .then((response) => {

                        // explore response in the devtools console to better understand the format of the data we receive back from the API
                        console.log(response);

                        // to loadGifs() we pass response.data.data which seems weird, but that's how Giphy has formatted their response JSON
                        // explore the console.log(response) in your dev tools and see for yourself!
                        this.loadGifs(response.data.data);
                    });
            },

            loadGifs(data) {
                // set our gifs property to contain the list of GIFs we just received from the response
                this.gifs = data;

                // now that we have gifs, open the dropdown menu to see them!
                this.dropdownOpen = true;
            },

            selectGif(gif) {
                // store the path of the GIF we selected, we'll pass the path to Laravel to create GIF comments
                console.log(gif);
                this.selectedGif = gif.fixed_height.url;

                // we've made a selection, so let's close the dropdown
                this.dropdownOpen = false;
            },
            doFocus(){
                // small UX improvement -- if we re-focus on the textfield, and it isn't empty, open the dropdown menu
                if(this.criteria) this.dropdownOpen = true;
            }
        },
        props: ['tweetId']
    }


</script>
