const app = Vue.createApp({
  data() {
    return {
      boxASelected: false,
      boxBSelected: false,
      boxCSelected: false,
    }
  },
  methods: {
    boxSelected(box) {
      if (box === 'A') {
        this.boxASelected = !this.boxASelected
        this.boxBSelected = false
        this.boxCSelected = false
      } else if (box === 'B') {
        this.boxASelected = false
        this.boxBSelected = !this.boxBSelected
        this.boxCSelected = false
      } else if (box === 'C') {
        this.boxASelected = false
        this.boxBSelected = false
        this.boxCSelected = !this.boxCSelected
      }
    },
  },
  computed: {
    boxAClasses() {
      return { active: this.boxASelected }
    },
    boxBClasses() {
      return { active: this.boxBSelected }
    },
    boxCClasses() {
      return { active: this.boxCSelected }
    },
  },
})

app.mount('#styling')
