// Laod the Inter font
import '@fontsource/inter/300.css';
import "@fontsource/inter/400.css";
import "@fontsource/inter/500.css";
import "@fontsource/inter/600.css";
import "@fontsource/inter/700.css";

// Load the mosparo scss
import './scss/mosparo.scss';

import '@tabler/core';

const $ = require('jquery');
global.$ = global.jQuery = $;

const dt = require('datatables.net');
const dtR = require('datatables.net-responsive');

import './js/form.js';