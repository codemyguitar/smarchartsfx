import { ref } from "vue"
import axios from "axios"
import { useRouter } from "vue-router"

export default function useContactList() {
    const contactList = ref([])
    const contactInformation = ref([])
    const router = useRouter()
    const errors = ref('')
    const getContactList = async () => {
        let response = await axios.get('api/contacts')

        contactList.value = response.data.data
    }
    const getContactInformation = async (id) => {
        let response = await axios.get('/api/contacts/' + id)

        contactInformation.value = response.data.data
    }
    const updateContactInformation = async(id) => {
        errors.value = ''

        try {
            await axios.put('/api/contacts/' + id, contactInformation.value)
            await router.push({name: 'contactList.index'})
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' -- '
                }
            } else {
                errors.value = 'General Error'
            }
        }

    }
    const saveNewContact = async(data) => {
        errors.value = ''

        try {
            await axios.post('api/contacts', data)
            await router.push({name: 'contactList.index'})
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' -- '
                }
            } else {
                errors.value = 'General Error'
            }
        }

    }
    const destroyContact = async(id) => {
        await axios.delete('api/contacts/' + id)
    }

    return {
        contactList,
        getContactList,
        destroyContact,
        saveNewContact,
        errors,
        contactInformation,
        getContactInformation,
        updateContactInformation
    }
}