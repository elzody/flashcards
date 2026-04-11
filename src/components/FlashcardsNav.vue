<template>
	<NcAppNavigation>
		<template #list>
			<NcAppNavigationCaption :name="t('flashcards', 'Flashcard Decks')" />
		</template>
	</NcAppNavigation>
</template>

<script>
import NcAppNavigation from '@nextcloud/vue/components/NcAppNavigation'
import NcAppNavigationCaption from '@nextcloud/vue/components/NcAppNavigationCaption'
import { translate as t } from '@nextcloud/l10n'

export default {
	name: 'FlashcardsNav',

	components: {
		NcAppNavigation,
		NcAppNavigationCaption,
	},

	methods: {
		t,
	},
}
</script>
