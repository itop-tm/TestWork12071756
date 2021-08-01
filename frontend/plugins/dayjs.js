var dayjs = require('dayjs');
dayjs.locale('tm', require('dayjs/locale/tk'));
require('dayjs/locale/ru');

export default function ({app}, inject) {
  inject('dayjs', dayjs)
}
