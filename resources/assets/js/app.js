
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('todo', require('./components/ToDo.vue'));
Vue.component('page-builder', require('./components/PageBuilder.vue'));
Vue.component('storyline-builder', require('./components/StorylineBuilder.vue'));

Vue.component('block', require('./components/partials/block.vue'));
Vue.component('item', require('./components/partials/item.vue'));
Vue.component('groups', require('./components/partials/groups.vue'));
Vue.component('group', require('./components/partials/group.vue'));

const app = new Vue({
    el: '#app'
});
