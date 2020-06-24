<template>
    <div>
        <h2 class="text-2xl font-medium">Form Pay</h2>
        <div class="mt-4">
            <div>
                <div class="flex flex-col sm:flex-row py-8">
                    <div class="w-2/3">
                        <label class="block mt-2">
                            <span class="text-gray-700">Document</span>
                        </label>
                        <input class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                               type="number"
                               readonly
                               v-model="client.document"
                        />
                        <label class="block mt-2">
                            <span class="text-gray-700">Phone</span>
                        </label>
                        <input class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                               type="number"
                               readonly
                               v-model="client.phone"
                        />
                        <label class="block mt-2">
                            <span class="text-gray-700">$</span>
                        </label>
                        <input class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                               type="number"
                               v-model="client.value"
                        />
                        <button @click="pay"
                                class="px-2 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-2xl font-medium rounded mt-4">
                            Pay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WalletForm",
        props: ["client"],
        methods : {
            pay() {
                let vm = this;
                vm.$emit('show-loading');

                axios.post(window.routes["api.client.payment.generate"], vm.client)
                    .then(function (response) {
                        toast.success("Pay success...");
                        vm.$emit('success-reload', vm.client);
                        vm.$emit('hide-loading');

                    })
                    .catch(function (error) {
                        toast.error(error.response.data)
                        vm.$emit('hide-loading');

                    })
            }
        }
    }
</script>