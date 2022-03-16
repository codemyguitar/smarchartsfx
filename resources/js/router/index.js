import { createRouter, createWebHistory } from "vue-router"
import ContactListIndex from '../components/ContactListIndex'
import contactListNew from '../components/ContactListNew'
import ContactListEdit from '../components/ContactListEdit'

const routes = [
    {
        path: '/',
        name: 'contactList.index',
        component: ContactListIndex
    },
    {
        path: '/new-contact',
        name: 'contactList.new',
        component: contactListNew
    },
    {
        path: '/edit-contact/:id',
        name: 'contactList.edit',
        component: ContactListEdit,
        props: true
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})