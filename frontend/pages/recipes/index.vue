<script setup>
const route = useRoute()
const router = useRouter()
const config = useRuntimeConfig()

const formData = ref({
  email: route.query.email || '',
  keyword: route.query.keyword || '',
  ingredient: route.query.ingredient || ''
});

const currentPage = ref(parseInt(route.query.page || '1'))

// Perform a new search and go back to page 1
const updateSearch = () => {
  currentPage.value = 1
  pushRoute()
}

// Reset the search and go back to page 1
const clearSearch = () => {
  formData.value.email = ''
  formData.value.keyword = ''
  formData.value.ingredient = ''
  currentPage.value = 1
  pushRoute()
}

// Change the page we're currently on
const paginateTo = (page) => {
  currentPage.value = page
  pushRoute()
}

// Update the route from our configuration
const pushRoute = async () => {
  await router.push({
    query: removeEmptyValues({
      ...formData.value,
      page: currentPage.value
    })
  })
}

// Set up the routine to fetch data
const { data: recipes, refresh: fetchRecipes } = await useAsyncData(() => {
  return $fetch(`${config.public.apiUrl}/recipes`, {
    params: removeEmptyValues({
      email: route.query.email || undefined,
      keyword: route.query.keyword || undefined,
      ingredient: route.query.ingredient || undefined,
      page: route.query.page || undefined
    })
  })
})

// Helper method to remove any undefined values from an object. Used before we send query params to our API.
const removeEmptyValues = (config) => {
  Object.keys(config).forEach(key => Boolean(config[key]) === false && delete config[key] );
  return config
}

// Whenever the route changes client side, update our form data and current page with whatever was set, and then
// refresh the data. This makes sure our forward/back button works as expected.
watch(route, (newRoute) => {
  formData.value.email = newRoute.query.email || ''
  formData.value.keyword = newRoute.query.keyword || ''
  formData.value.ingredient = newRoute.query.ingredient || ''
  currentPage.value = parseInt(newRoute.query.page || '1')

  fetchRecipes()
})

// Load recipes before sending to client when server side rendering
await fetchRecipes()
</script>

<template>
  <div class="bg-emerald-50 min-h-screen">
    <div class="container mx-auto pt-12 px-4">
      <!-- Search Form -->
      <section class="flex justify-between items-center mb-12">
        <h1 class="text-3xl font-light mb-4">Recipe Search Demo</h1>
        <form @submit.prevent="updateSearch" class="flex justify-start space-x-2">
          <input v-model="formData.email" type="email" placeholder="Email" class="ring-1 ring-inset ring-gray-300 shadow-sm rounded-md px-4 py-2 text-gray-600 placeholder:text-gray-500 text-sm" />
          <input v-model="formData.keyword" type="text" placeholder="Keyword" class="ring-1 ring-inset ring-gray-300 shadow-sm rounded-md px-4 py-2 text-gray-600 placeholder:text-gray-500 text-sm"/>
          <input v-model="formData.ingredient" type="text" placeholder="Ingredient" class="ring-1 ring-inset ring-gray-300 shadow-sm rounded-md px-4 py-2 text-gray-600 placeholder:text-gray-500 text-sm"/>
          <button type="submit" class="bg-cyan-800 hover:bg-cyan-700 text-white px-4 py-1 text-sm font-light shadow-sm rounded-md">Search</button>
          <button type="button" @click="clearSearch" class="bg-white ring-1 ring-gray-400 text-sm text-gray-800 px-4 py-1 rounded-md ">Clear</button>
        </form>
      </section>

      <section v-if="recipes.data.length > 0">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
          <article v-for="recipe in recipes.data" :key="recipe.slug" class="bg-white rounded-md shadow-md px-4 py-4 flex flex-col">
            <div class="flex justify-between">
              <NuxtLink :to="{ name: 'recipes-slug', params: { slug: recipe.slug } }" class="text-cyan-700 hover:text-cyan-500  tracking-wide text-xl">
                {{ recipe.name }}
              </NuxtLink>
              <div>
                <span class="text-xs bg-amber-100 rounded-2xl px-2 py-1 text-xs">{{ recipe.author.email}}</span>
              </div>
            </div>

            <p class="text-sm my-3 text-lime-800">{{ recipe.description}}</p>

            <div class="mt-auto">
              <p class="text-xs text-lime-800 mr-1 inline-block">Includes:</p>
              <ul class="inline-block">
                <li v-for="ingredient in recipe.ingredients" class="inline-block text-xs pr-1 after:content-['|'] after:ml-1 last:after:content-none text-lime-800">
                  {{ingredient.name}}
                </li>
              </ul>
            </div>

          </article>
        </div>
      </section>


      <div v-else class="bg-white rounded-md shadow-md py-16 px-4">
        <p class="text-xl text-center">No recipes found</p>
      </div>

      <!-- Pagination Controls -->
      <nav class="flex justify-center space-x-12 pt-8 pb-16">
        <button @click="paginateTo(currentPage - 1)" :disabled="currentPage === 1" class="bg-white hover:bg-gray-200 border rounded-xl border-cyan-800 shadow-md px-2 py-1 text-xs">
          ← Back
        </button>
        <span>Page {{ currentPage }} of {{ recipes.meta.last_page }}</span>
        <button @click="paginateTo(currentPage + 1)" :disabled="currentPage === recipes.meta.last_page" class="bg-white hover:bg-gray-200 border rounded-xl border-cyan-800 shadow-md px-2 py-1 text-xs">
          Next →
        </button>
      </nav>
    </div>
  </div>
</template>

<style scoped>

</style>
