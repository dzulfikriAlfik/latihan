const app = Vue.createApp({
  data() {
    return {
      goals: [],
      enteredGoalValue: '',
    }
  },
  methods: {
    addGoal() {
      this.goals.push(this.enteredGoalValue)
      this.enteredGoalValue = ''
    },
  },
})

app.mount('#user-goals')
