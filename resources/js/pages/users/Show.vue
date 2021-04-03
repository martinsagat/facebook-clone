<template>
<div class="flex flex-col items-center" v-if="status.user === 'success' && user">
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

        <div class="absolute flex items-center bottom-0 right-0 mb-4 mr-12 z-20">
            <button v-if="friendButtonText && friendButtonText !== 'Accept'"
                    class="py-1 px-3 bg-gray-400 rounded"
                    @click="$store.dispatch('sendFriendRequest', $route.params.userId)">
                {{ friendButtonText }}
            </button>
            <button v-if="friendButtonText && friendButtonText === 'Accept'"
                    class="mr-2 py-1 px-3 bg-blue-500 rounded"
                    @click="$store.dispatch('acceptFriendRequest', $route.params.userId)">
                Accept
            </button>
            <button v-if="friendButtonText && friendButtonText === 'Accept'"
                    class="py-1 px-3 bg-gray-400 rounded"
                    @click="$store.dispatch('ignoreFriendRequest', $route.params.userId)">
                Ignore
            </button>
        </div>
    </div>

    <div v-if="status.posts === 'loading'">Loading Posts...</div>
    <div v-else-if="posts.data.length < 1">No posts found. Get Started..</div>
    <Post v-else v-for="(post,postKey) in posts.data" :post="post" :key="postKey" />

</div>
</template>

<script>
import Post from '../../components/Post';

export default {
    name: 'Show',
    components: {
        Post
    },

    computed: {
        user() { return this.$store.getters.user; },
        posts() { return this.$store.getters.posts; },
        status() { return this.$store.getters.status; },
        friendButtonText() { return this.$store.getters.friendButtonText; }
    },

    mounted() {

        this.$store.dispatch('fetchUser',this.$route.params.userId)
        this.$store.dispatch('fetchUserPosts',this.$route.params.userId)
    }
}
</script>

<style scoped>

</style>