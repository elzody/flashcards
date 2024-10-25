<template>
	<NcContent app-name="flashcards">
		<FlashcardsNav />
	</NcContent>
</template>

<script>
import NcContent from '@nextcloud/vue/dist/Components/NcContent.js'
import FlashcardsNav from './components/FlashcardsNav.vue'

export default {
	name: 'App',

	components: {
		NcContent,
		FlashcardsNav,
	},
}
</script>
