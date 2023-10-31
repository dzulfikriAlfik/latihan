const app = Vue.createApp({
  data() {
    return {
      counter: 0,
      name: '',
      lastName: '',
      // fullname: '',
    }
  },
  methods: {
    increment() {
      this.counter++
    },
    decrement() {
      this.counter > 0 && this.counter--
    },
    submitForm() {
      alert('submitted')
    },
    resetInput() {
      this.name = ''
      this.lastName = ''
    },
  },
  computed: {
    fullname() {
      return this.name !== '' ? `${this.name} ${this.lastName}` : ''
    },
  },
  watch: {
    // name(value, oldValue) {
    //   // console.log('value:', value, '| oldValue:', oldValue)

    //   if (value === '') {
    //     this.fullname = ''
    //   } else {
    //     this.fullname = `${value} Alkautsari`
    //   }
    // },
    counter(value) {
      if (value > 10) {
        alert('Stop there!')
        this.counter = 10
      }
    },
  },
})

app.mount('#events')
