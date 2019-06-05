<template>
    <div class="container">
        <input type="file" name="image" @change="GetImage" accept="image/*">
        <img :src="avatar" alt="Image">
        <a href="#" class="btn btn-success" @click.prevent="upload">Upload</a>
    </div>
    <upload-component :user="{{auth()->user()}}"></upload-component>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return{
                avatar: this.user.avatar
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            GetImage(e){
                console.log(e.target)
                let image = e.target.files[0]
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    console.log(e)
                    this.avatar = e.target.result
                }
            },
            upload(){
                axios.post('/upload',{'image':this.avatar})
            }
        }
    }
</script>
