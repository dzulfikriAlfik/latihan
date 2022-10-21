const app = Vue.createApp({
  data() {
    return {
      counter: 0,
      name: '',
      yourName: ''
    };
  },
  methods: {
    setName(event, lastName) {
      this.name = event.target.value + ' ' + lastName
    },
    confirmedName() {
      this.yourName = this.name
    },
    addCounter (number) {
      return this.counter += number
    },
    removeCounter (number) {
      if(this.counter == 0) return 0
      return this.counter -= number
    }
  },
});

app.mount('#events');
