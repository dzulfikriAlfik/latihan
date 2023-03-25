<template>
  <li>
    <h2>{{ name }} {{ isFavorite ? '(Favorite)' : '' }}</h2>
    <button @click="toggleDetails">
      {{ detailAreVisible ? 'Hide' : 'Show' }} Detail
    </button>
    <button @click="toggleFavorite">Toggle Favorite</button>
    <ul v-if="detailAreVisible">
      <li><strong>Phone : </strong>{{ phoneNumber }}</li>
      <li><strong>Email : </strong>{{ emailAddress }}</li>
    </ul>
    <button @click="$emit('delete-contact', id)">Delete</button>
  </li>
</template>

<script>
export default {
  // props: ['name', 'phoneNumber', 'emailAddress', 'isFavorite'],
  props: {
    id: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    phoneNumber: {
      type: String,
      required: true
    },
    emailAddress: {
      type: String,
      required: true
    },
    isFavorite: {
      type: Boolean,
      required: false,
      default: false
      // validator(value) {
      //   return value === '1' || value === '0'
      // }
    }
  },
  emits: ['toggle-favorite', 'delete-contact'],
  // emits: {
  //   'toggle-favorite': function (id) {
  //     const validated = id ? true : false
  //     !validated && console.warn('Id is missing')
  //     return validated
  //   }
  // },
  data() {
    return {
      detailAreVisible: false
    }
  },
  methods: {
    toggleDetails() {
      this.detailAreVisible = !this.detailAreVisible
    },
    toggleFavorite() {
      this.$emit('toggle-favorite', this.id)
    }
  }
}
</script>
