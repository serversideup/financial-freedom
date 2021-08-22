require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex'

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

Vue.use(Vuex);

const app = document.getElementById('app');

import { transactions } from './Modules/transactions/transactions.js';

const store = new Vuex.Store({
    modules: {
        transactions
    }
})

new Vue({
    store,
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
