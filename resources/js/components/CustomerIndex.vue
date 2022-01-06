<template>
    <div class="flex flex-col">
        <div class="flex mb-3">
            <!-- On crée le lien crée un customer -->
            <router-link :to="{name: 'customers.create'}" class="bg-green-500 px-2 py-1 text-white rounded">Créer un client</router-link>
        </div>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Téléphone
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Is Favourite ?
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- On boucle sur les customers -->
                            <template v-for="customer in customers" :key="customer.id">
                                <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                    <div class="ml-4">
                                        <!-- On injecte le nom -->
                                        <div class="text-sm font-medium text-gray-900" v-text="customer.name">
                                        </div>
                                    </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <!-- On injecte le tel -->
                                    <div class="text-sm text-gray-900" v-text="customer.tel"></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    v-bind:class="{ 'bg-green-100 text-green-800': customer.is_favourite }"
                                    v-text="customer.is_favourite">
                                    </span>
                                </td>
                                <!-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Admin
                                </td> -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <router-link :to="{ name: 'customers.edit', params: { id: customer.id }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Éditer</router-link>
                                    <button @click="deleteCustomer(customer.id)" class="text-red-600 hover:text-red-900">Supprimer</button>
                                </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// On importe le hook onMounted de vue
import { onMounted } from "vue";
// On importe le customerservices
import useCustomers from "../services/customerservices.js";

export default {
    // la fonction setup se déclenche avant l'initialisation total du composant et après les props
    setup() {
        // On récupère les variables et methodes de notre service
        const { customers, getCustomers, destroyCustomer } = useCustomers();
        // deleteCustomer est la méthode qui click sur le btn Supprimer
        // elle fait appelle à la methode destroyCustomer de notre service useCustomers||customerservices
        const deleteCustomer = async (id) => {
            await destroyCustomer(id);
        };
        // Hook onMounted - Quand le composant sera monté tu appelles la methode getCustomers
        onMounted(getCustomers());

        return {
            customers, // tu retournes nos customers
            deleteCustomer
        };
    }

}
</script>
