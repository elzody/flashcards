<template>
	<NcAppNavigation>
		<template #list>
			<NcAppNavigationItem name="first item" />
		</template>
	</NcAppNavigation>
</template>

<script setup>
import NcAppNavigation from '@nextcloud/vue/dist/Components/NcAppNavigation.js'
import NcAppNavigationItem from '@nextcloud/vue/dist/Components/NcAppNavigationItem.js'
</script>