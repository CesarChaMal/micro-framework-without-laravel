<template>
    <div>
        <h2 class="text-2xl font-medium">Create Client</h2>
        <div class="mt-4">
            <div>
                <div class="flex flex-col sm:flex-row py-8">
                    <div class="w-2/3">
                        <label class="block mt-2">
                            <span class="text-gray-700">Name</span>
                        </label>
                        <input class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                               type="text"
                               v-model="client.full_name"
                        />

                        <label class="block mt-2">
                            <span class="text-gray-700">Email</span>
                        </label>
                        <input class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                               type="email"
                               v-model="client.email"
                        />
                        <label class="block mt-2">
                            <span class="text-gray-700">Document</span>
                        </label>
                        <input class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                               type="number"
                               v-model="client.document"
                        />
                        <label class="block mt-2">
                            <span class="text-gray-700">Phone</span>
                        </label>
                        <input class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                               type="number"
                               v-model="client.phone"
                        />
                        <button @click="create"
                                class="px-2 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-2xl font-medium rounded mt-4">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "ClientForm",
        data() {
            return {
                client: {
                    full_name: "",
                    phone: "",
                    email: "",
                    document: ""
                }
            }
        },
        methods : {
            create() {
                let vm = this;

                axios.post(window.routes["api.client"], vm.client)
                    .then(function (response) {
                        toastr.success("Create success...");

                        vm.$emit('success-create', vm.client);
                    })
                    .catch(function (error) {
                        toast.error(error.response.data)
                    })
            }
        }
    }
</script>