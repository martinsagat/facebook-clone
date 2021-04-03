<template>
    <div class="flex flex-col items-center py-4">
        
        <NewPost />

        <p v-if="newsStatus.postsStatus === 'loading'">Loading Posts...</p>
        <Post v-else v-for="(post, postKey) in posts.data" :post="post" :key="postKey" />

    </div>
</template>

<script>
    import NewPost
    from '../components/NewPost';
    import Post from '../components/Post';

    export default {
        name: "NewsFeed",

        components: {
            NewPost,
            Post,
        },

        computed: {
            posts() { return this.$store.getters.newsPosts; },
            newsStatus() { return this.$store.getters.newsStatus; }
        },

        mounted() {
            this.$store.dispatch('fetchNewsPosts')
            
        }
    }
</script>

<style scoped>

</style>
