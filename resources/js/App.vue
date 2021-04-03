<template>
    <div class="flex flex-col flex-1 h-screen overflow-y-hidden" v-if="authUser">
        <Nav />
          
        <div class="flex overflow-y-hidden flex-1">

            <Sidebar class="hidden sm:block transform sm:transform-gpu " />
            
            <div class="overflow-x-hidden w-full sm:w-2/3">
                <router-view :key="$route.fullPath"></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import Nav from './components/Nav';
    import Sidebar from './components/Sidebar';

    export default {
        name: "App",

        components: {
            Nav,
            Sidebar
        },

        watch: {
            $route(to, from) { 
                this.$store.dispatch('setPageTitle', to.meta.title)
            }
        },

        computed: {
            authUser() { return this.$store.getters.authUser; }
        },

        mounted() {
            this.$store.dispatch('fetchAuthUser');
        },

        created() {
            this.$store.dispatch('setPageTitle', this.$route.meta.title)
        }
    }
</script>

<style scoped>

</style>