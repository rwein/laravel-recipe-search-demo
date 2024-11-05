<script setup xmlns="http://www.w3.org/1999/html">
const route = useRoute()
const config = useRuntimeConfig()

const { data: recipe, error } = await useFetch(`${config.public.apiUrl}/recipes/${route.params.slug}`,)
</script>

<template>
  <div class="bg-emerald-50 min-h-screen">
    <div class="container mx-auto pt-12 px-4">
      <div v-if="error">
        <p class="text-4xl">Error fetching recipe</p>
      </div>

      <article v-else>
        <div class="flex items-center space-x-6">
          <h1 class="text-4xl font-light mb-2">
            {{ recipe.data.name }}
          </h1>
          <div>
            <span class="bg-amber-100 rounded-2xl px-2 py-1">{{ recipe.data.author.email}}</span>
          </div>
        </div>

        <p class="text-xl mt-6">{{ recipe.data.description}}</p>

        <p class="text-xl mt-8 mb-2 text-lime-800">Ingredients</p>
        <ul class="list-disc list-inside">
          <li v-for="ingredient in recipe.data.ingredients" class="mb-1 text-lime-800">
            {{ingredient.amount}} {{ingredient.unit}} {{ingredient.name}}
          </li>
        </ul>

        <p class="text-xl mt-8 mb-2 text-lime-800">Instructions</p>
        <ol class="list-decimal list-inside">
          <li v-for="step in recipe.data.steps" class="mb-1 text-lime-800">
            {{step.instructions}}
          </li>
        </ol>
      </article>
    </div>
  </div>
</template>
