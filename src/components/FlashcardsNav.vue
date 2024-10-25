<template>
	<NcAppNavigation>
		<template #list>
			<NcAppNavigationCaption :name="t('flashcards', 'Flashcard Decks')" is-heading>
				<template #actions>
					<NcActionButton :aria-label="t('flashcards', 'Create a deck')">
						<template #icon>
							<PlusIcon />
						</template>
					</NcActionButton>
				</template>
			</NcAppNavigationCaption>
		</template>
	</NcAppNavigation>
</template>

<script>
import NcAppNavigation from '@nextcloud/vue/dist/Components/NcAppNavigation.js'
import NcAppNavigationCaption from '@nextcloud/vue/dist/Components/NcAppNavigationCaption.js'
import NcActionButton from '@nextcloud/vue/dist/Components/NcActionButton.js'
import PlusIcon from 'vue-material-design-icons/Plus.vue'
import { translate as t } from '@nextcloud/l10n'

export default {
	name: 'FlashcardsNav',

	components: {
		NcAppNavigation,
		NcAppNavigationCaption,
		NcActionButton,
		PlusIcon,
	},

	methods: {
		t,
	},
}
</script>
