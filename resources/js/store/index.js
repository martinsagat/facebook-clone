import Vue from 'vue';
import Vuex from 'vuex';

import Users from './modules/User';
import Title from './modules/Title';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Users,
        Title,
    }
});