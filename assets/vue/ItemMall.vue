<template>
		<div class="grid grid-cols-2 gap-6">
				<div class="col">
						<p class="mb-2">
								<span class="text-gray-200 font-light">You currently have </span>
								<span class="text-white font-bold">{{ userCoinBalance }}</span>
								<span class="text-gray-200 font-light"> coins</span>
						</p>
				</div>
				<div class="col text-right">
						<input type="text" class="bg-neutral-950 border-0 text-neutral-400 font-medium w-1/2" placeholder="Voucher Code"/>
						<button v-if="!voucherRedeemProcess" @click="redeemVoucher" class="bg-neutral-800 hover:bg-neutral-700 text-gray-200 font-semibold px-4 py-2 w-1/3">Redeem item voucher</button>
						<button v-else type="button" class="cursor-not-allowed inline-flex items-center w-1/3 justify-center gap-x-2 bg-neutral-700 text-gray-200 px-4 py-2 font-semibold">
								<svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
										<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
										<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
								</svg>
								Redeeming...
						</button>
				</div>
		</div>
		<div class="grid grid-cols-16 gap-6">
				<div class="col-span-4">
						<div class="w-full">
								<nav class="flex flex-1 flex-col" aria-label="Sidebar">
										<div class="flex items-start mb-4">
												<h2 class="text-lg font-bold text-gray-200">Categories</h2>
										</div>
										<div v-if="categories.length === 0" class="animate-pulse flex space-x-4">
												<div class="flex-1 space-y-6 py-1">
														<div class="h-5 bg-neutral-800 rounded"></div>
														<div class="h-5 bg-neutral-800 rounded"></div>
														<div class="h-5 bg-neutral-800 rounded"></div>
														<div class="h-5 bg-neutral-800 rounded"></div>
												</div>
										</div>
										<ul role="list" class="-mx-2 space-y-1">
												<template v-for="category in categories" :key="category.id">
														<li v-if="category.active" @click="selectCategory(category.id)">
																<a href="javascript:;" :class="{ 'bg-neutral-700' : selectedCategory === category.id }" class="text-gray-200 hover:text-gray-200 hover:bg-neutral-800 group flex gap-x-3 rounded-md p-2 pl-3 text-sm leading-6 font-semibold">
																		{{ category.name }}
																		<span class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-green-800 px-2.5 py-0.5 text-center text-xs font-medium leading-5 text-gray-200 ring-1 ring-inset ring-green-500" aria-hidden="true">{{ category.item_count }}</span>
																</a>
														</li>
												</template>
										</ul>
								</nav>
						</div>
				</div>
				<div class="col-span-12">
						<div class="w-full">
								<div class="flex items-start mb-4">
										<h2 class="text-lg font-bold text-gray-200">Items</h2>
								</div>
								<div v-if="selectedCategory.length === 0" class="flex justify-center">
										<h2 class="text-md font-semibold text-gray-500">Select a category to start browsing the shop</h2>
								</div>
								<div v-else-if="items.length === 0" class="grid grid-cols-2 gap-5">
										<div class="col">
												<div class="md:container mx-auto p-4 animate-pulse">
														<div class="grid grid-cols-16 gap-1">
																<div class="col-span-3 flex items-center">
																		<div class="rounded-md bg-neutral-800 h-20 w-20"></div>
																</div>
																<div class="col-span-12">
																		<div class="h-5 bg-neutral-800 rounded mb-2 w-52"></div>
																		<div class="h-3 bg-neutral-800 rounded mb-2"></div>
																		<div class="h-3 bg-neutral-800 rounded w-40"></div>
																</div>
														</div>
												</div>
										</div>
										<div class="col">
												<div class="md:container mx-auto p-4 animate-pulse">
														<div class="grid grid-cols-16 gap-1">
																<div class="col-span-3 flex items-center">
																		<div class="rounded-md bg-neutral-800 h-20 w-20"></div>
																</div>
																<div class="col-span-12">
																		<div class="h-5 bg-neutral-800 rounded mb-2 w-52"></div>
																		<div class="h-3 bg-neutral-800 rounded mb-2"></div>
																		<div class="h-3 bg-neutral-800 rounded w-40"></div>
																</div>
														</div>
												</div>
										</div>
								</div>
								<div v-else class="grid grid-cols-2 gap-5">
										<div class="col" v-for="item in items" :key="item.key">
												<div class="md:container bg-neutral-800 rounded-md drop-shadow-md p-4 mx-auto transition ease-in-out hover:scale-102 hover:cursor-pointer" @click="openModal(item)">
														<div class="grid grid-cols-16 gap-1">
																<div class="col-span-3 flex items-center">
																		<img :src="item.image ? require('@images/shop/' + item.image + '.jpg') : require('@images/shop/ItemPlaceholder.png')" class="rounded-md shadow-md max-h-px-80"/>
																</div>
																<div class="col-span-12">
																		<div v-if="item.isDiscounted" class="flex items-start">
																				<p class="text-gray-200 font-bold">{{ item.name }}</p>
																				<span class="ml-2 w-9 min-w-max whitespace-nowrap rounded-full bg-green-800 px-2.5 py-0.5 text-center text-xs font-medium leading-5 text-gray-200 ring-1 ring-inset ring-green-500" aria-hidden="true">Discounted</span>
																		</div>
																		<div v-else class="flex items-start">
																				<p class="text-gray-200 font-bold">{{ item.name }}</p>
																		</div>
																		<p class="text-gray-400 text-sm">{{ item.shortDescription }}</p>
																		<div class="flex items-start mt-2">
																				<p v-if="item.isDiscounted" class="text-sm font-bold text-gray-200 mr-1"><strike>{{ item.price }}</strike> {{ item.price - (item.price * (item.discount / 100)) }}</p>
																				<p v-else class="text-sm font-bold text-gray-200 mr-1">{{ item.price }}</p>
																				<CurrencyDollarIcon class="h-5 w-5 text-yellow-400"/>
																		</div>
																</div>
														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>

		<ItemModal :showModal="showModal" :selectedItem="selectedItem" :buyProcess="buyProcess" @closeModal="closeModal" @buyItem="buyItem" />
		<ToastNotification :showNotification="showNotification" :notificationContent="notificationContent" />
</template>

<script setup>
import { CurrencyDollarIcon } from "@heroicons/vue/24/solid";
import ToastNotification from "@/Components/ToastNotification.vue";
import ItemModal from "@/Components/ItemModal.vue";
</script>

<script>
import axios from 'axios';

export default {
		name: 'ItemMall',
		data() {
				return {
						categories: [],
						items: [],
						selectedCategory: [],
						showModal: false,
						showNotification: false,
						notificationContent: {},
						selectedItem: null,
						buyProcess: false,
						notificationTimeoutId: null,
						userCoinBalance: 0,
						voucherRedeemProcess: false,
				};
		},
		created() {
				axios.get('/api/shop/category/list')
						.then(response => {
								this.categories = response.data.data;
						})
						.catch(error => console.error('Error:', error));

				axios.get('/api/account/user/coin-balance')
						.then(response => {
								this.userCoinBalance = response.data.data.coin_balance;
						})
						.catch(error => console.error('Error:', error));
		},
		methods: {
				selectCategory(categoryId) {
						this.selectedCategory = categoryId;
						this.items = [];

						axios.get('/api/shop/item/category/' + categoryId)
								.then(response => {
										this.items = response.data.data;
								})
								.catch(error => console.error('Error:', error));
				},
				buyItem(itemId) {
						this.buyProcess = true;

						axios.post('/api/shop/item/buy', { itemId: itemId })
								.then(response => {
										if (response.data.status !== 200) {
												this.notificationContent = {
														success: false,
														message: response.data.message,
												};
										} else {
												this.notificationContent = {
														success: true,
														message: response.data.message,
												};
												this.updateCoinBalance();
												this.closeModal();
										}
								})
								.catch((error) => {
										this.notificationContent = {
												success: false,
												message: error.data.message,
										};
								})
								.finally(() => {
										this.buyProcess = false;
										this.showNotification = true;

										if (this.notificationTimeoutId) {
												clearTimeout(this.notificationTimeoutId);
										}

										this.notificationTimeoutId = setTimeout(() => this.hideNotification(), 5000);
								});
				},
				openModal(item) {
						this.selectedItem = item;
						this.showModal = true;
				},
				closeModal() {
						this.showModal = false;
				},
				hideNotification() {
						this.notificationContent = {};
						this.showNotification = false;
				},
				updateCoinBalance() {
						fetch(window.location.origin + '/api/account/user/coin-balance')
								.then(response => response.json())
								.then(data => {
										this.userCoinBalance = data.data.coin_balance
								})
								.catch(error => console.error('Error:', error));
				},
				redeemVoucher() {
						this.voucherRedeemProcess = true;
				}
		},
}
</script>

<style scoped>

</style>