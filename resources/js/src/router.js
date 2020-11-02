/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: '/',
    scrollBehavior () {
        return { x: 0, y: 0 }
    },
    routes: [

        {
    // =============================================================================
    // MAIN LAYOUT ROUTES
    // =============================================================================
            path: '',
            component: () => import('./layouts/main/Main.vue'),
            children: [
        // =============================================================================
        // Theme Routes
        // =============================================================================
              {
                path: '/page/home',
                name: 'home',
                  meta: {
                      auth: true
                  },
                component: () => import('./views/Home.vue'),
              },
            ],
        },
    // =============================================================================
    // FULL PAGE LAYOUTS
    // =============================================================================
        {
            path: '',
            component: () => import('./layouts/full-page/FullPage.vue'),
            children: [
        // =============================================================================
        // PAGES
        // =============================================================================
              {
                path: '/',
                name: 'login',
                  meta: {
                      auth: false
                  },
                component: () => import('./views/pages/Login.vue')
              },
              {
                path: '/page/register',
                name: 'register',
                  meta: {
                      auth: false
                  },
                component: () => import('./views/pages/Register.vue')
              },
              {
                path: '/page/error-404',
                name: 'error-404',
                  meta: {
                      auth: false
                  },
                component: () => import('./views/pages/Error404.vue')
              },
            ]
        },
        // Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: 'error-404'
        }
    ],
})

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = "none";
    }
})

router.beforeEach( (to, from, next) => {

    if (to.meta.auth && !window.Laravel.checkLogin) {
        return router.push({name: 'login'}).catch(()=>{});
    }

    if ((to.name === 'login' || to.name === 'register') && window.Laravel.checkLogin) {
        return router.push({name: 'home'}).catch(()=>{});
    }

    return next()
})

export default router
