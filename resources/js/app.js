import './bootstrap';
import './lucide';
import Chart from 'chart.js/auto';

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.plugin(persist);
Alpine.start();
