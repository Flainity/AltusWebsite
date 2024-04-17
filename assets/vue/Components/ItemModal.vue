<script setup>

import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from "@headlessui/vue";
import {CurrencyDollarIcon, GiftIcon, ShoppingCartIcon} from "@heroicons/vue/24/solid";
</script>

<template>
		<TransitionRoot as="template" :show="showModal">
				<Dialog as="div" class="relative z-10" @close="closeModal">
						<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
								<div class="fixed inset-0 bg-neutral-900 bg-opacity-80 transition-opacity" />
						</TransitionChild>

						<div class="fixed inset-0 z-10 overflow-y-auto">
								<div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
										<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
												<DialogPanel class="relative transform overflow-hidden border-1 border-neutral-700 rounded-lg bg-neutral-800 px-4 pb-4 pt-5 text-left shadow-lg transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
														<div>
																<img :src="selectedItem.image ? require('@images/shop/' + selectedItem.image + '.jpg') : require('@images/shop/ItemPlaceholder.png')" alt="Item image" class="mx-auto items-center justify-center rounded-md shadow-md max-h-px-80"/>
																<div class="mt-3 text-center sm:mt-5">
																		<DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-200">{{ selectedItem.name }}</DialogTitle>
																		<div class="mt-2">
																				<p class="text-sm text-gray-400">{{ selectedItem.shortDescription }}</p>
																		</div>
																</div>
																<div class="relative my-3">
																		<div class="absolute inset-0 flex items-center" aria-hidden="true">
																				<div class="w-full border-t border-gray-400"></div>
																		</div>
																		<div class="relative flex justify-center">
																				<span class="bg-neutral-800 px-3 text-base font-semibold leading-6 text-gray-200">Details</span>
																		</div>
																</div>
																<div class="mb-3">
																		<p class="text-sm text-gray-400">{{ selectedItem.description }}</p>
																</div>
																<div class="flex items-start mt-2">
																		<p class="text-gray-400 mr-1">Unit:</p>
																		<p class="font-bold text-gray-200 mr-1">x{{ selectedItem.unit }}</p>
																</div>
																<div class="mb-3 flex items-start">
																		<p class="text-gray-400 mr-1">Price:</p>
																		<p v-if="selectedItem.discount" class="font-bold text-gray-200 mr-1"><strike>{{ selectedItem.price }}</strike> {{ selectedItem.price - (selectedItem.price * (selectedItem.discount / 100)) }}</p>
																		<p v-else class="font-bold text-gray-200 mr-1">{{ selectedItem.price }}</p>
																		<CurrencyDollarIcon class="h-5 w-5 text-yellow-400"/>
																</div>
														</div>
														<div class="mt-5 sm:mt-6 grid grid-cols-2 gap-2">
																<div class="col">
																		<button v-if="!buyProcess" type="button" @click="buyItem(selectedItem.id)" class="inline-flex w-full items-center justify-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
																				<ShoppingCartIcon class="h-5 w-5 text-white"/>
																				Purchase
																		</button>
																		<button v-else type="button" disabled @click="buyItem(selectedItem.id)" class="cursor-not-allowed inline-flex w-full items-center justify-center gap-x-2 rounded-md bg-indigo-400 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
																				<svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
																						<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
																						<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
																				</svg>
																				Processing...
																		</button>
																</div>
																<div class="col">
																		<button type="button" class="inline-flex w-full items-center justify-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
																				<GiftIcon class="h-5 w-5 text-white"/>
																				Gift
																		</button>
																</div>
														</div>
												</DialogPanel>
										</TransitionChild>
								</div>
						</div>
				</Dialog>
		</TransitionRoot>
</template>

<script>
export default {
		name: 'ItemModal',
		props: {
				showModal: {
						type: Boolean,
						default: false
				},
				selectedItem: {
						type: Object,
						default: () => ({
								id: 0,
								name: '',
								shortDescription: '',
								description: '',
								unit: 0,
								price: 0,
								discount: 0,
								image: ''
						})
				},
				buyProcess: {
						type: Boolean,
						default: false
				}
		},
		methods: {
				closeModal() {
						this.$emit('closeModal');
				},
				buyItem(itemId) {
						this.$emit('buyItem', itemId);
				}
		}
}
</script>

<style scoped>

</style>