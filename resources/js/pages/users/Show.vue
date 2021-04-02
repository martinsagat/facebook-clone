<template>
<div class="flex flex-col items-center">
    <div class="relative mb-8">
        <div class="w-100 h-64 overflow-hidden z-10">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7f/Zugspitze_-_June_2018_-_31911455517.jpg" alt="User Background Image" class="object-cover w-full"/>
        </div>

        <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
            <div class="div.w-32">
                <img src="https://cdn.pixabay.com/photo/2014/07/09/10/04/man-388104_960_720.jpg" alt="profile image for user" class="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg">
            </div>
        
            <p class="text-2xl text-gray-100 ml-4">{{ user.data.attributes.name }}</p>
        </div>
    </div>

    <p v-if="postLoading">Loading Posts...</p>
    
    <Post v-else v-for="post in posts.data" :post="post" :key="post.data.post_id" />

    <p v-if="! postLoading && posts.data.length < 1">No posts found. Get Started..</p>

</div>
</template>

<script>
import Post from '../../components/Post';

export default {
    name: 'Show',
    components: {
        Post
    },
    data() {
        return {
            userLoading: true,
            postLoading: true,
            user: null,
            posts: null,
        }
    },

    mounted() {
        axios.get('/api/users/'+ this.$route.params.userId)
            .then(res => {
                this.user = res.data;
            })
            .catch(err => {

                console.log('Unable to fetch the user from the server.')
                console.log(err)
            
            })
            .finally(() => {
                this.userLoading = false
            })

        axios.get('/api/users/'+ this.$route.params.userId + '/posts')
            .then(res => {
                this.posts = res.data;
            })
            .catch( err => {

                console.log('Unable to fetch posts');
                console.log(err);
            
            })
            .finally(() => {
                this.postLoading = false
            })
    }
}
</script>

<style scoped>

</style>