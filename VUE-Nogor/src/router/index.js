import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import NogorView from '../views/Nogor/view.vue'
import NogorCreate from '../views/Nogor/create.vue'
import NogorEdit from '../views/Nogor/edit.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/nogor',
      name: 'nogorView',
      component: NogorView
    },
    {
      path: '/nogor/create',
      name: 'nogorCreate',
      component: NogorCreate
    },
    {
      path: '/nogor/:id/edit',
      name: 'nogorEdit',
      component: NogorEdit
    },
  ]
})

export default router
