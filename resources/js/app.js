require('./bootstrap');


import { createApp } from "vue";
import router from './router';
import ContactListIndex from './components/ContactListIndex';
import ContactListNew from './components/ContactListNew';
import ContactListEdit from './components/ContactListEdit';

createApp({
    components: {
        ContactListIndex,
        ContactListNew,
        ContactListEdit
    }
}).use(router).mount("#app");