/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 window.Pusher = require('pusher-js');
 import Echo from "laravel-echo";



require('./bootstrap');

window.Vue = require('vue');
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
// require('bootstrap-sass');

var PUSHER_KEY = 'your-pusher-key';

var NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\UserFollowed',
    newPost: 'App\\Notifications\\NewPost'
};

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: PUSHER_KEY,
    cluster: 'eu',
    encrypted: true
});

var notifications = [];

$(document).ready(function () {
    // check if there's a logged in user
    if (Laravel.userId) {
        // load notifications from database
        $.get('/notifications', function (data) {
            addNotifications(data, "#notifications");
        });

        // listen to notifications from pusher
        window.Echo.private('App.User.' + Laravel.userId).notification(function (notification) {
            addNotifications([notification], '#notifications');
        });
    }
});

// add new notifications
function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

// show notifications
function showNotifications(notifications, target) {
    if (notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications');
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
        $(target).removeClass('has-notifications');
    }
}

// create a notification li element
function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return '<li><a href="' + to + '">' + notificationText + '</a></li>';
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = '?read=' + notification.id;
    if (notification.type === NOTIFICATION_TYPES.follow) {
        to = 'users' + to;
    } else if (notification.type === NOTIFICATION_TYPES.newPost) {
        var postId = notification.data.post_id;
        to = 'posts/' + postId + to;
    }
    return '/' + to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    if (notification.type === NOTIFICATION_TYPES.follow) {
        var name = notification.data.follower_name;
        text += '<strong>' + name + '</strong> followed you';
    } else if (notification.type === NOTIFICATION_TYPES.newPost) {
        var _name = notification.data.following_name;
        text += '<strong>' + _name + '</strong> published a post';
    }
    return text;
}
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('tweet-component', require('./components/TweetComponent.vue').default);
Vue.component('comments-component', require('./components/CommentsComponent.vue').default);
Vue.component('comment-component', require('./components/CommentComponent.vue').default);
Vue.component('commenting-component', require('./components/CommentingComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('timeline-component', require('./components/TimelineComponent.vue').default);
Vue.component('comment-form', require('./components/CommentForm.vue').default);
Vue.component('follow-component', require('./components/FollowComponent.vue').default);
// Vue.component('upload-component', require('./components/UploadComponent.vue').default);
Vue.component('giph-component', require('./components/GiphComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
$(document).ready(function(){
  $('form input').change(function () {
    $('form p').text(this.files.length + " file(s) selected");
  });
});

var cors = require('cors');
var bodyParser = require('body-parser');

 new Vue({
    el: 'body'
});
const app = new Vue({
    el: '#app',
        data(){
            return{
                tweets: [],
                lastTweetId: 0,
                lastTimeChecked: 0
            }
        },
        methods:{
            initialTweets(){
            axios.get("/api/tweetsbynumber/5")
            // axios.get("/api/tweetsbynumber/100?user_id/")
            .then((response) => {
            this.tweets = response.data.data;
            this.lastTweetId = response.data.data[((response.data.data).length -1)]["id"];
            console.log(response.data.data);
        });
    },

        scroll(){
            window.onscroll = () => {
                if ((window.innerHeight + window.srcollY) >=
            (document.body.offsetHeight -0.5)){
                var startPoint = this.lastTweetId;

                if((new Date).getTime() > (this.lastCallTime + 500)){
                axios.get("/api/tweetsbynumberfromstartpoint/5/" + this.lastTweetId)
                .then((response) => {
                      var data = response.data.data;
                for (var i = 0; i < data.length; i++){
                        this.tweets.push(data[i]);
                        this.lastTweetId = data[i]["id"];
                        console.log(this.lastTweetId);
                    }

                });

                this.lastTimeChecked = (new Date).getTime();
                }
            }
        };
    },
},
        mounted(){
         this.initialTweets();
         this.scroll();
     }
});
new Vue({
  // state
  data () {
    return {
      count: 0
    }
  },
  // view
  template: `
    <div>{{ count }}</div>
  `,
  // actions
  methods: {
    increment () {
      this.count++
    }
  }
});
