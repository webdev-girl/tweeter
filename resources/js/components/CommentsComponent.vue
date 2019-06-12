<template>
    <div class="comment">
        <div class="comment-content">
            <comment-component v-for="comment in comments" :comment="comment" :key="comment.id"></comment-component>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('CommentsComponent mounted.')
            this.initialComments();
        },
        data(){
            return{
                comments: [],
            }
        },
        methods:{
            initialComments(){
                axios.get("/api/tweet-comments/" + this.tweetId)
                    .then((response) => {
                        this.comments = response.data.data;
                })
            }
        },
        props: ['tweetId']
    }
</script>


 <style>
  /* body {
    background-color: #DDD;
    font-family: 'Raleway', sans-serif;
    background: #ffffff;
    background: -moz-radial-gradient(center, ellipse cover,  #ffffff 0%, #ededed 100%);
    background: -webkit-radial-gradient(center, ellipse cover,  #ffffff 0%,#ededed 100%);
    background: radial-gradient(ellipse at center,  #ffffff 0%,#ededed 100%);
    background-attachment: fixed;
  }
  #app {
    width: 60%;
    margin: 4rem auto;
    text-align: center;
    transition: all ease .6s;
  }
  .brand h3{
    color: #47b784;
    font-size: 2em;
  }
  .brand h3 span {
    color: #36495d
  }
  .btn-primary {
    box-shadow: 2px 2px 2px #d2d2d2;
    background-color: #6f8aa7;
    padding: .5em 2em;
    display: inline-block;
    color: #FFF;
    text-decoration: none;
    border-radius: 3px;
    transition: all ease 0.3s;
  }
  .btn-primary:hover {
    background-color: #47b784
  }
  .comment-list {
    padding: 1em 0;
  }
  .comment-list ul{
    margin: 0;
    padding: 1em;
  }
  .comment-list li{
    list-style: none;
    text-align: left;
    overflow: hidden;
    margin-bottom: 2em;
    padding: .4em;
  }
  .comment-list .profile {
    width: 80px;
    float: left;
  }
  .comment-list .profile img {
    border-radius: 50%;
    border: 2px solid #FFF;
    width: 48px;
    height: 48px;
    background-color: #DDD;
    box-shadow: 0 0 5px #DDD;
  }
  .comment-list .msg {
    width: 86%;
    float: left;
    background-color: #FFF;
    border-radius: 0 5px 5px 5px;
    box-shadow: 0 4px 8px -2px rgba(0,0,0, 0.05);
    position: relative;
  }
  .comment-list .msg-body {
    padding: .8em;
    color: #666;
    line-height: 1.5
  }
  .comment-list .msg-body p:last-child {
    margin-bottom: 0;
  }
  .comment-list .msg-body:after {
    content: ' ';
    position: absolute;
    left: -13px;
    top: 0;
    border: 14px solid;
    border-color: #fff transparent transparent transparent;
  }
  .comment-list .name {
    margin: 0;
    color: #999;
    font-weight: bold;
    font-size: .8em;
  }
  .comment-list .date {
    float: right;
  }
  @media(max-width: 1200px){
      #app{
           width: 80%;
      }
      .comment-list .msg {
        width: 80%;
      }
  }
  @media(max-width: 600px){
      #app{
           width: 95%;
           margin: 2rem auto;
      }
      .brand img {
        width: 80px;
      }
      .brand h3 {
        font-size: 1.6em;
      }
      .comment-list .msg {
        width: 70%;
      }
  }
  .spinner {
    width: 20px;
    height: 20px;
    background-color: #47b784;
    display: inline-block;
    -webkit-animation: sk-rotateplane 1.2s infinite ease-in-out;
    animation: sk-rotateplane 1.2s infinite ease-in-out;
  }
  @-webkit-keyframes sk-rotateplane {
    0% { -webkit-transform: perspective(120px) }
    50% { -webkit-transform: perspective(120px) rotateY(180deg) }
    100% { -webkit-transform: perspective(120px) rotateY(180deg)  rotateX(180deg) }
  }
  @keyframes sk-rotateplane {
    0% {
      transform: perspective(120px) rotateX(0deg) rotateY(0deg);
      -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg);
      background-color: #47b784;
    } 50% {
      transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
      -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
      background-color: #36495d;
    } 100% {
      transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
      -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
      background-color: #47b784;
    }
  } */
</style> */
