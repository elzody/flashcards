<template>
	<NcAppNavigation>
		<template #list>
			<NcAppNavigationCaption name="Flashcard decks">
				<template #actions>
					<NcActionButton>
						<template #icon>
							<Plus />
						</template>
					</NcActionButton>
				</template>
			</NcAppNavigationCaption>
		</template>
	</NcAppNavigation>
</template>

<script setup lang="ts">
import NcAppNavigation from '@nextcloud/vue/dist/Components/NcAppNavigation.js'
import NcAppNavigationCaption from '@nextcloud/vue/dist/Components/NcAppNavigationCaption.js'
import NcActionButton from '@nextcloud/vue/dist/Components/NcActionButton.js'
import Plus from 'vue-material-design-icons/Plus.vue'
</script>
