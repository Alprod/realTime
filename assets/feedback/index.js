// assets/feedback/index.js
import Vue from 'vue';
import StarRating from 'vue-star-rating';
import Feedback from './Feedback';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUserSecret } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

Vue.component('star-rating', StarRating);
Vue.component('font-awesome-icon', FontAwesomeIcon);

new Vue({
    el: '#feedback',
    components: {Feedback}
});
