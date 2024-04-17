<script setup>

import ToastNotification from "@/Components/ToastNotification.vue";
</script>

<template>
		<ul v-if="characters.length > 0" role="list" class="divide-y divide-neutral-700">
				<li v-for="character in characters" :key="character.id" class="grid grid-cols-16 py-4">
						<div class="col-span-2">

						</div>
						<div class="col-span-9">
								<div class="flex items-start gap-x-3">
										<p class="text-sm font-semibold leading-6 text-gray-200">{{ character.name }}</p>
										<p class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-green-200 bg-green-700 ring-green-900/20">{{ character.shape.className }}</p>
								</div>
								<div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-400">
										<p class="whitespace-nowrap">Created on {{ character.createdAt }}</p>
								</div>
						</div>
						<div class="col-span-5 flex flex-col justify-center">
								<div class="flex justify-end gap-x-2">
										<a v-if="!positionFixInProgress" @click="fixPosition(character.id)" class="cursor-pointer rounded-md bg-neutral-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-white/20">Fix position</a>
										<button v-else type="button" disabled class="cursor-not-allowed inline-flex w-full items-center justify-center gap-x-2 rounded-md bg-neutral-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
												<svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
														<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
														<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
												</svg>
												Processing...
										</button>
								</div>
						</div>
				</li>
		</ul>
		<p v-else class="text-sm leading-6 text-gray-400">You don't have any characters yet. Create one now!</p>

		<ToastNotification :show-notification="showNotification" :notification-content="notificationContent"/>
</template>

<script>
import axios from "axios";

export default {
		data() {
				return {
						characters: [],
						positionFixInProgress: false,
						showNotification: false,
						notificationContent: []
				}
		},
		mounted() {
				axios.get('/api/characters/list').then(response => {
						this.characters = response.data.data;
				});
		},
		methods: {
				fixPosition(characterId) {
						this.positionFixInProgress = true;
						axios.post('/api/characters/fix-position', { characterId }).then(response => {
								this.showNotification = true;
								this.notificationContent = {
										success: true,
										message: response.data.message
								}
								this.positionFixInProgress = false;
						});
				}
		}
}
</script>

<style scoped>

</style>