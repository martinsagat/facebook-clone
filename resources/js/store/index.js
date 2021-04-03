import Vue from 'vue';
import Vuex from 'vuex';

import User from './modules/User';
import Title from './modules/Title';
import Profile from './modules/Profile';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        User,
        Title,
        Profile,
    }
});