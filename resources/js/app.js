import './bootstrap';
import Alpine from 'alpinejs'
import Clipboard from "@ryangjchandler/alpine-clipboard"
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import { easepick } from '@easepick/core';
import { RangePlugin } from '@easepick/range-plugin';
import { PresetPlugin } from '@easepick/preset-plugin';



Alpine.plugin(Clipboard);
window.tippy = tippy;
window.easepick = easepick;
window.RangePlugin = RangePlugin;
window.PresetPlugin = PresetPlugin;

//initiate AplineJS
window.Alpine = Alpine
Alpine.start()
