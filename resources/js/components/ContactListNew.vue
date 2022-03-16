<template>
    <div class="w-100 text-center">
        <h3>Create New Contact</h3>
    </div>
    <div v-if="errors" class="m-4 text-danger">
        {{ errors }}
    </div>

    <form @submit.prevent="storeNewContact">
        <div>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="name" v-model="form.name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" name="address" id="address" v-model="form.address" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" name="phone" id="phone" v-model="form.phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="">FB Username</label>
                <input type="text" name="fb_username" id="fb_username" v-model="form.fb_username" class="form-control">
            </div>
        </div>
        <router-link :to="{ name: 'contactList.index' }">
            <button type="button" class="btn btn-secondary mr-2">Cancel</button>
        </router-link>
        <button type="submit" class="btn btn-success">Save New Contact</button>
    </form>
</template>

<script>
import ContactListIndex from '../composables';
import { reactive } from "vue";

export default {
    setup() {
        const { saveNewContact, errors } = ContactListIndex()
        const form = reactive({
            'name': '',
            'phone': '',
            'address': '',
            'fb_username': ''
        })
        const storeNewContact = async () => {
            await saveNewContact({ ...form });
        }


        return {
            form,
            errors,
            storeNewContact
        }
    }
}
</script>