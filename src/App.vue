<template>
	<NcContent app-name="flashcards">
		<FlashcardsNav />
		<NcAppContent>
			<!-- Main content will go here -->
		</NcAppContent>
	</NcContent>
</template>

<script>
import NcContent from '@nextcloud/vue/components/NcContent'
import NcAppContent from '@nextcloud/vue/components/NcAppContent'
import FlashcardsNav from './components/FlashcardsNav.vue'

export default {
	name: 'App',

	components: {
		NcContent,
		NcAppContent,
		FlashcardsNav,
	},
}
</script>
