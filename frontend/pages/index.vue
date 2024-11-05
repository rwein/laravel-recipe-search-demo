<script setup lang="ts">
  import { navigateTo } from 'nuxt/app'
  import { onMounted } from 'vue'

  onMounted(() => {
    navigateTo('/recipes') // Redirect to recipes whenever the base path is loaded
  })
</script>
