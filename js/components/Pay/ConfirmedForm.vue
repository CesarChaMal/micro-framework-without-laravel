<template>
    <div>
        <h2 class="text-2xl font-medium">Confirmed Pay</h2>
        <div class="mt-4">
            <div>
                <div class="flex flex-col sm:flex-row py-8">
                    <div class="w-2/3">
                        <label class="block mt-2">
                            <span class="text-gray-700">Token</span>
                        </label>
                        <input class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                               type="number"
                               v-model="token"
                        />
                        <label class="block mt-2">
                            <span class="text-gray-700">Session</span>
                        </label>
                        <input class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                               type="text"
                               v-model="session"
                        />
                        <button @click="confirmed"
                                class="px-2 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-2xl font-medium rounded mt-4">
                            Confirmed
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "ConfirmedForm",
        props: ["client"],
        data() {
            return {
                token: null,
                session: null
            }
        },
        methods: {
            confirmed() {
                let vm = this;

                axios.post(window.routes["api.client.payment.confirmed"],
                    {
                        token: vm.token,
                        session: vm.session
                    })
                    .then(function (response) {
                        toast.success("Pay Confirmed success...");

                        vm.$emit('success-reload', vm.client);
                    })
                    .catch(function (error) {
                        toast.error(error.response.data)
                    })
            },
        }
    }
</script>