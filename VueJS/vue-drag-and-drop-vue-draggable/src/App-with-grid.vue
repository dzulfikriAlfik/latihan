<template>
  <div id="app">
    <draggable
      v-model="items"
      :move="handleMove"
      @end="handleDragEnd"
      class="grid"
      name="grid"
      item-key="id"
    >
      <template #item="{ element: item }">
        <transition-group tag="div" class="cell">
          {{ item }}
        </transition-group>
      </template>
    </draggable>
  </div>
</template>

<script>
import draggable from "vuedraggable";

export default {
  name: "App",
  components: {
    draggable,
  },
  data() {
    return {
      items: [1, 2, 3, 4, 5, 6, 7, 8, 9],
    };
  },
  methods: {
    handleDragEnd() {
      this.futureItem = this.items[this.futureIndex];
      this.movingItem = this.items[this.movingIndex];
      const _items = Object.assign([], this.items);
      _items[this.futureIndex] = this.movingItem;
      _items[this.movingIndex] = this.futureItem;

      this.items = _items;
    },
    handleMove(e) {
      const { index, futureIndex } = e.draggedContext;
      this.movingIndex = index;
      this.futureIndex = futureIndex;
      return false; // disable sort
    },
  },
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.grid {
  display: grid;
  grid-template-columns: repeat(3, 100px);
  grid-template-rows: repeat(3, 100px);
  grid-gap: 0.2em;
}

.grid-move {
  transition: all 0.3s;
}

.cell {
  background-color: lightblue;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
