const app = Vue.createApp({
  data () {
    return {
      friends: [
        {
          id: 'dzulfikri',
          name: 'Dzulfikri Alkautsari',
          phone: '082121884879',
          email: 'dzulfikrialfik@gmail.com'
        },
        {
          id: 'alfik',
          name: 'Alfik',
          phone: '089507436748',
          email: 'alfikperfect@gmail.com'
        },
      ]
    }
  }
})

app.component('friend-contact', {
  template: `
  <li>
    <h2>{{ friend.name   }}</h2>
    <button @click="toggleDetails()">{{ detailsShown ? "Hide" : "Show" }} Details</button>
    <ul v-if="detailsShown">
      <li><strong>Phone:</strong> {{ friend.phone }}</li>
      <li><strong>Email:</strong> {{ friend.email }}</li>
    </ul>
  </li>
  `,
  data () {
    return {
      detailsShown: false,
      friend: {
        id: 'alfik',
        name: 'Alfik',
        phone: '089507436748',
        email: 'alfikperfect@gmail.com'
      },
    }
  },
  methods: {
    toggleDetails () {
      this.detailsShown = !this.detailsShown
    }
  }
})

app.mount("#app")