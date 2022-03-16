<template>
    <div class="w-100 text-center">
        <h3>Edit Contact</h3>
    </div>
    <div v-if="errors" class="m-4 text-danger">
        {{ errors }}
    </div>

    <form @submit.prevent="saveContactInformation">
        <div>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="name" v-model="contactInformation.name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" name="address" id="address" v-model="contactInformation.address" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" name="phone" id="phone" v-model="contactInformation.phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="">FB Username</label>
                <input type="text" name="fb_username" id="fb_username" v-model="contactInformation.fb_username" class="form-control">
            </div>
        </div>
        <router-link :to="{ name: 'contactList.index' }">
            <button type="button" class="btn btn-secondary mr-2">Cancel</button>
        </router-link>
        <button type="submit" class="btn btn-success">Update Contact</button>
    </form>
</template>

<script>
import useContactList from '../composables'
import { onMounted } from 'vue'

export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },

    setup(props) {
        const { contactInformation, getContactInformation, updateContactInformation, errors } = useContactList()

        onMounted(getContactInformation(props.id))

        const saveContactInformation = async () => {
            await updateContactInformation(props.id)
        }

        return {
            contactInformation,
            saveContactInformation,
            errors
        }
    }
}

</script>