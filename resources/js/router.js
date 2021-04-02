import Vue from 'vue';
import VueRouter from 'vue-router';
import NewsFeed from './pages/NewsFeed.vue';
import UserShow from './pages/users/Show.vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    
    routes: [
        {
            path: '/',
            name: 'Home',
            component: NewsFeed,
            meta: { title: 'News Feed' },
        },
        {
            path: '/users/:userId',
            name: 'user.show',
            component: UserShow,
            meta: { title: 'Profile' },
        }
    ]
});