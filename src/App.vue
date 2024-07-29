<template>
  <div>{{ count }}</div>
</template>

<script>
import NcAppContent from '@nextcloud/vue/dist/Components/NcAppContent.js'

export default {
  name: 'App',

  components: {
    NcAppContent,
  },

  data() {
    return {
      count: 0,
    }
  },
}
</script>
