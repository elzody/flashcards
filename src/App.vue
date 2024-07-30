<template>
  <NcAppNavigation></NcAppNavigation>
</template>

<script>
import { NcAppNavigation } from '@nextcloud/vue'

export default {
  name: 'App',

  components: {
    NcAppNavigation,
  },

  data() {
    return {
      count: 0,
    }
  },
}
</script>
