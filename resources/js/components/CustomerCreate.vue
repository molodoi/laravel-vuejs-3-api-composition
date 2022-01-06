<template>
    <div v-if="errors !== ''">
        {{ errors }}
    </div>
    <!-- @submit gère la soumission du formulaire et transmet les datas à la méthode storeCustomer içi plus bas dans script -->
    <form class="space-y-6" @submit.prevent="storeCustomer">
        <div>
            <label class="block" for="name">
                <span class="text-gray-700">Nom du client</span>
                <input type="text" id="name" v-model="form.name" class="form-input mt-1 block w-full rounded" placeholder="Jane Doe" />
            </label>
        </div>
        <div>
            <label class="block" for="tel">
                <span class="text-gray-700">Tél. du client</span>
                <input type="text" id="tel" v-model="form.tel" class="form-input mt-1 block w-full rounded" placeholder="00.00.00.00.00" />
            </label>
        </div>
        <div>
            <label for="is_favourite" class="flex items-center">
                <input type="checkbox" id="is_favourite" v-model="form.is_favourite" class="form-checkbox rounded" />
                <span class="ml-2">Favori ?</span>
            </label>
        </div>
        <button type="submit" class="bg-blue-500 px-2 py-1 text-white rounded">Enregistrer</button>
    </form>
</template>

<script>
// On importe le hook reactive de vue
import { reactive } from "vue"
// On importe le customerservices
import useCustomers from "../services/customerservices.js";

export default {
    // Setup initialise avant le composant
    setup() {
        // On crée notre constante form à l'aide de la fonction reactive de vue 
        // à qui on passe un objet qui représente les datas de notre formulaire
        const form = reactive({
            name: '',
            tel: '',
            is_favourite: '',
        });
        // On récupère la methode createCustomer depuis notre service customerservices as useCustomers
        const { createCustomer, errors } = useCustomers();
        // storeCustomer est la méthode qui est lancée lorsque l'on submit le formulaire
        const storeCustomer = async () => {
            // { ... dans cette objet je récupère les clés valeur de l'objet form }
            await createCustomer({...form});
        };
        // On retourne/partage avec la vue les variables et methodes de ce composant
        return {
            form,
            errors,
            storeCustomer
        }
    }
}
</script>
