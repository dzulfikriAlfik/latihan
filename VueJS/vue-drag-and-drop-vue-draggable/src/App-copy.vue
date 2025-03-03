<template>
  <draggable class="drop-zone" v-model="items" item-key="id" tag="div">
    <template #item="{ element: item }">
      <div class="drag-el">
        {{ item.title }}
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
        { id: 1, title: "Item A" },
        { id: 2, title: "Item B" },
        { id: 3, title: "Item C" },
        { id: 4, title: "Item D" },
        { id: 5, title: "Item E" },
        { id: 6, title: "Item F" },
        { id: 7, title: "Item G" },
        { id: 8, title: "Item H" },
        { id: 9, title: "Item I" },
        { id: 10, title: "Item J" },
        { id: 11, title: "Item K" },
        { id: 12, title: "Item L" },
        { id: 13, title: "Item M" },
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

  display: grid;
  grid-template-columns: repeat(5, 1fr);
  grid-template-rows: repeat(5, 1fr);
  grid-column-gap: 0px;
  grid-row-gap: 0px;
}

.drag-el {
  background-color: #3498db;
  color: white;
  padding: 5px;
  margin-bottom: 10px;
  cursor: move;
}

.drag-el:nth-last-of-type(1) {
  margin-bottom: 0px;
}
</style>
