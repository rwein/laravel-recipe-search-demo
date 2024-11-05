// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  compatibilityDate: "2024-11-03",
  runtimeConfig: {
    public: {
      apiUrl: process.env.API_URL || 'http://localhost:8888/api'
    }
  },
  modules: ['@nuxtjs/tailwindcss']
})
