<template>
  <draggable class="drop-zone" :lists="items" v-model="items" item-key="id">
    <template #item="{ element }" class="drop-zone">
      <div class="drag-el">
        {{ element.title }}
      </div>
    </template>
  </draggable>
</template>

<script>
import draggable from "vuedraggable";

export default {
  components: {
    draggable,
  },
  data() {
    return {
      items: [
        { id: 1, title: "Item A", list: 1 },
        { id: 2, title: "Item B", list: 1 },
        { id: 3, title: "Item C", list: 2 },
      ],
    };
  },
  methods: {},
};
</script>

<style>
.drop-zone {
  width: 50%;
  margin: 50px auto;
  background-color: #ecf0f1;
  padding: 10px;
  min-height: 10px;
}

.drag-el {
  background-color: #3498db;
  color: white;
  padding: 5px;
  margin-bottom: 10px;
}

.drag-el:nth-last-of-type(1) {
  margin-bottom: 0px;
}
</style>
