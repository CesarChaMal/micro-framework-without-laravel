<template>
    <div class="flex flex-wrap -mx-4">
        <div class="w-full md:w-1/3 px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-gray-500 uppercase font-bold text-xs">
                                Total
                            </h5>
                            <span class="font-semibold text-xl text-gray-800">
                              {{ total }}
                            </span>
                        </div>
                        <div class="relative w-auto px-2 flex-initial">
                            <div
                                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                        <span class="whitespace-no-wrap" v-if="client">
                            {{ client.document }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TotalCard",
        props: ["client"],
        mounted () {
            this.$parent.$on('get-total', this.reload);

            this.reload();
        },
        computed : {
          total() {
              return this.client == null ? 0 : this.client.total;
          }
        },
        methods: {
            reload() {
                if(this.client == null) {
                    return;
                }

                let vm = this;
                vm.$emit('show-loading')

                axios.get(window.routes["api.client.total"] + "?document=" + vm.client.document + "&phone=" + vm.client.phone)
                    .then(function (response) {
                        vm.client.total = response.data;
                        vm.$emit('hide-loading')
                    })
                    .catch(function (error) {
                        vm.$emit('error-total', error);
                        vm.$emit('hide-loading')
                        toast.error(error.response.data)
                    })
            }
        },
    }
</script>

<style scoped>

</style>