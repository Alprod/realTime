import Vue from 'vue';
import Reactions from './Reactions';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faAngry, faGrinHearts, faGrinStars, faAlignRight } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.config.productionTip = false;
library.add(faAngry, faGrinHearts, faGrinStars, faAlignRight);



new Vue({
    el: '#reactions',
    components: {Reactions}
})