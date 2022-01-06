<template>
    <div v-if="errors !== ''">
        {{ errors }}
    </div>
    <!-- @submit gère la soumission du formulaire et transmet les datas à la méthode saveCustomer içi plus bas dans script -->
    <form class="space-y-6" @submit.prevent="saveCustomer">
        <div>
            <label class="block" for="name">
                <span class="text-gray-700">Nom du client</span>
                <input type="text" id="name" v-model="customer.name" class="form-input mt-1 block w-full rounded" />
            </label>
        </div>
        <div>
            <label class="block" for="tel">
                <span class="text-gray-700">Tél. du client</span>
                <input type="text" id="tel" v-model="customer.tel" class="form-input mt-1 block w-full rounded" />
            </label>
        </div>
        <div>
            <label for="is_favourite" class="flex items-center">
                <input type="checkbox" id="is_favourite" v-model="customer.is_favourite" class="form-checkbox rounded" />
                <span class="ml-2">Favori ?</span>
            </label>
        </div>
        <button type="submit" class="bg-blue-500 px-2 py-1 text-white rounded">Mettre à jour</button>
    </form>
</template>

<script>
// On importe le hook reactive de vue
import { reactive } from "vue";
// On importe le hook onMounted de vue
import { onMounted } from "vue";
// On importe le customerservices
import useCustomers from "../services/customerservices.js";

export default {
    // on définit une props en l'occurence l'id de l'url en y affectant quelques contrainte
    props: {
        id: {
            required: true,
            type: String
        }
    },
    // la fonction setup se déclenche avant l'initialisation total du composant et après les props
    // on transmet nos props (l'id) à la methode setup
    setup(props) {
        // On récupère les variables et methodes de notre service dont on a besoin
        const { getCustomer, customer, updateCustomer, errors } = useCustomers();
        // Hook onMounted - Quand le composant sera monté on appelle la methode getCustomer
        // En lui transmettant props.id pour recupérer le customer
        onMounted(getCustomer(props.id));
        // saveCustomer est la méthode qui est lancée lorsque l'on submit le formulaire
        // elle fait appelle à la methode updateCustomer de notre service useCustomers||customerservices
        const saveCustomer = async () => {
            await updateCustomer(props.id);
        };
        // On retourne/partage avec la vue les variables et methodes de ce composant
        return {
            saveCustomer,
            customer,
            errors
        }
    }
}
</script>
