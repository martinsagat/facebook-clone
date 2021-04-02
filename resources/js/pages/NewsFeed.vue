<template>
    <div class="flex flex-col items-center py-4">
        <NewPost />

        <p v-if="loading">Loading Posts...</p>
        <Post v-else v-for="post in posts.data" :post="post" :key="post.data.post_id" />

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

        data() {
            return {
                loading: true,
                posts: null,
            }
        },

        mounted() {

            axios.get('/api/posts')
                .then(res => {
                    this.posts = res.data;
                    this.loading = false;
                })
                .catch( err => {
                    console.log('Unable to fetch posts');
                    console.log(err);
            });
        }
    }
</script>

<style scoped>

</style>
