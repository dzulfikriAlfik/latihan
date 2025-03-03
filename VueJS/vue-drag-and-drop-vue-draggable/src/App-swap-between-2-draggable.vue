<template>
  <div class="row">
    <div class="col-3">
      <h3>My LEGO Bionicles</h3>
      <draggable
        class="list-group"
        data-list="list1"
        :list="list1"
        group="bionicles"
        @change="log"
        itemKey="id"
        :move="handleMoveItem"
        @end="handleDragEndItem"
        :options="{ animation: 500 }"
      >
        <template #item="{ element, index }">
          <div class="list-group-item" :style="element.style">
            {{ element.name }}
          </div>
        </template>
      </draggable>
    </div>
    <div class="col-3">
      <h3>Favourite LEGO Bionicle</h3>
      <draggable
        class="list-group"
        data-list="list2"
        :list="list2"
        group="bionicles"
        @change="log"
        itemKey="id"
        :move="handleMoveItem"
        @end="handleDragEndItem"
        :options="{ animation: 500 }"
      >
        <template #item="{ element, index }">
          <div class="list-group-item" :style="element.style">
            {{ element.name }}
          </div>
        </template>
      </draggable>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";
export default {
  name: "two-lists-swap",
  display: "Swapping between 2 lists",
  order: 1,
  components: {
    draggable,
  },
  data() {
    return {
      list1: [
        { name: "TOA Mata Nui", id: 1, style: { background: "gold" } },
        {
          name: "TOA Tahu",
          id: 2,
          style: { background: "red", color: "yellow" },
        },
        { name: "TOA Kopaka", id: 3, style: { background: "white" } },
        {
          name: "TOA Anakin",
          id: 4,
          style: { background: "black", color: "yellow" },
        },
      ],
      list2: [
        {
          name: "TOA Gali",
          id: 5,
          style: { background: "blue", color: "yellow" },
        },
        {
          name: "TOA Lewa",
          id: 6,
          style: { background: "green", color: "yellow" },
        },
        {
          name: "TOA Pohatu",
          id: 7,
          style: { background: "brown", color: "white" },
        },
      ],
    };
  },
  methods: {
    handleDragEndItem() {
      if (this.originalList === this.futureList) {
        this.movingItem = this[this.futureList][this.originalIndex];
        this.futureItem = this[this.futureList][this.futureIndex];

        if (this.movingItem && this.futureItem) {
          let _list = Object.assign([], this[this.futureList]);
          _list[this.futureIndex] = this.movingItem;
          _list[this.originalIndex] = this.futureItem;
          this[this.futureList] = _list;
        }
      } else {
        this.movingItem = this[this.originalList][this.originalIndex];
        this.futureItem = this[this.futureList][this.futureIndex];

        if (this.movingItem && this.futureItem) {
          let _listFrom = Object.assign([], this[this.originalList]);
          let _listTo = Object.assign([], this[this.futureList]);
          _listTo[this.futureIndex] = this.movingItem;
          _listFrom[this.originalIndex] = this.futureItem;
          this[this.originalList] = _listFrom;
          this[this.futureList] = _listTo;
        }
      }
      document
        .querySelectorAll(".list-group-item")
        .forEach((el) => (el.style.border = "none"));
      this.$toast.show("dragEnd");
    },
    handleMoveItem(event) {
      document
        .querySelectorAll(".list-group-item")
        .forEach((el) => (el.style.border = "none"));
      const { index, futureIndex } = event.draggedContext;
      this.originalIndex = index;
      this.futureIndex = futureIndex;
      this.originalList = event.from.getAttribute("data-list");
      this.futureList = event.to.getAttribute("data-list");
      if (this[this.futureList][this.futureIndex]) {
        event.to.children[this.futureIndex].style.border = "2px solid orange";
      }
      return false; // disable sort
    },
  },
};
</script>
<style>
.row {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 30px;
}
.list-group-item {
  padding: 5px 10px;
  cursor: grab;
}
</style>
