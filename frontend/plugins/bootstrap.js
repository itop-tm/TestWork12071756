
import qs from 'qs';
import Inputmask from "inputmask";

if (process.browser) {
  global.Popper = window.popper = require('popper.js');
  global.$ = global.jQuery = require('jquery');
  global.bootstrap = require('bootstrap');
  require('./theme.js');
  window.cl = (val) => console.log(val)
}

if (typeof JSON.clone !== "function") {
  JSON.clone = function(obj) {
      return JSON.parse(JSON.stringify(obj));
  };
}

export default function ({app}, inject) {
  function lp(path) {
    return `${app.localePath('/') + path}`
  }
  inject('lp', lp);
  inject('qs', qs);
}
