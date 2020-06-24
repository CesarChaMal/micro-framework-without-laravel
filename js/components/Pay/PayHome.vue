<template>
    <div>
        <loading
                :show="show"
                label="Loading">
            <content-loader>
                <rect x="0" y="0" rx="3" ry="3" width="250" height="10"/>
                <rect x="20" y="20" rx="3" ry="3" width="220" height="10"/>
                <rect x="20" y="40" rx="3" ry="3" width="170" height="10"/>
                <rect x="0" y="60" rx="3" ry="3" width="250" height="10"/>
                <rect x="20" y="80" rx="3" ry="3" width="200" height="10"/>
                <rect x="20" y="100" rx="3" ry="3" width="80" height="10"/>
            </content-loader>
        </loading>

        <div>
            <total-card
                    v-show="client !== null"
                    :client="client"
                    ref="totalCardComponent"
                    @hide-loading="show = false"
                    @show-loading="show = true"
                    v-on:error-total="hideTotal">
            </total-card>
            <base-panel class="mt-4">
                <div v-if="client === null" class="flex">
                    <div class="w-2/4">
                        <total-form client="client" ref="TotalForm"
                                    v-on:success-total="showTotal"></total-form>
                    </div>
                    <div class="w-2/4">
                        <client-form v-on:success-create="showTotal"
                                     @hide-loading="show = false"
                                     @show-loading="show = true">
                        </client-form>
                    </div>
                </div>
                <div v-if="client !== null" class="flex">
                    <div class="w-2/4">
                        <wallet-form v-on:success-reload="showTotal"
                                     :client="client"
                                     @hide-loading="show = false"
                                     @show-loading="show = true"></wallet-form>
                    </div>
                    <div class="w-2/4">
                        <pay-form v-on:success-reload="showTotal" :client="client"
                                  @hide-loading="show = false"
                                  @show-loading="show = true">
                        </pay-form>
                    </div>
                    <div class="w-2/4">
                        <pay-confirmed :client="client"
                                       v-on:success-reload="showTotal"
                                       @hide-loading="show = false"
                                       @show-loading="show = true">
                        </pay-confirmed>
                    </div>
                </div>
            </base-panel>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PayHome",
        data() {
            return {
                client: null,
                show: false
            }
        },
        methods: {
            showTotal(client) {
                let vm = this;
                vm.client = client;
                vm.$emit("get-total");
            },
            hideTotal(error) {
                this.client = null;
            }
        }
    }
</script>

<style scoped>

</style>