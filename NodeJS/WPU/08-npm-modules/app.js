const validator = require('validator')

console.log('isEmail : ', validator.isEmail('alfik@gmail.com'))
console.log(
  'isMobilePhone : ',
  validator.isMobilePhone('6282121884879', 'id-ID')
)
console.log('isNumeric : ', validator.isNumeric('12344231'))
