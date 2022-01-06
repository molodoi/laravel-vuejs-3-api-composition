import { ref } from "vue";
import axios from "axios";
import router from "../router/index.js";

export default function useCustomers() {
    // ref() pour une variable reactive
    const errors = ref('');
    const customer = ref([]);
    const customers = ref([]);

    // On récupère les customers
    const getCustomers = async () => {
        let response = await axios.get('/api/customers');
        customers.value = response.data.data;
    };
    // On récupère un customer by id
    const getCustomer = async (id) => {
        let response = await axios.get('/api/customers/' + id);
        customer.value = response.data.data;
    };
    // On crée un customer
    const createCustomer = async (data) => {
        errors.value = '';
        try {
            await axios.post('/api/customers', data);
            await router.push({name: 'customers.index'});
        } catch (error) {
            const createCustomerErrors = error.response.data.errors;

            for (const key in createCustomerErrors) {
                errors.value += createCustomerErrors[key][0] + ' ';
            }
        }
    };
    // On update un customer
    const updateCustomer = async (id) => {
        errors.value = '';
        try {
            await axios.put('/api/customers/' + id, customer.value);
            await router.push({name: 'customers.index'});
        } catch (error) {
            const createCustomerErrors = error.response.data.errors;

            for (const key in createCustomerErrors) {
                errors.value += createCustomerErrors[key][0] + ' ';
            }
        }
    };
    // On supprime un customer
    const destroyCustomer = async (id) => {
        if (!window.confirm('Supprimer ce client ?')) return;

        await axios.delete('/api/customers/' + id);
        await getCustomers();
    };
    // On retourne les variables et methodes dont on a besoin de notre service
    return {
        customers,
        customer,
        errors,
        getCustomer,
        getCustomers,
        createCustomer,
        updateCustomer,
        destroyCustomer
    };
}
