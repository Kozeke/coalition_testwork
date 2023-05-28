<template>
  <div>
    <div class="flex items-center justify-between px-3 py-2">
      <h3 class="text-sm font-semibold text-gray-700">{{ list.name }}</h3>
      <Menu as="div" class="relative z-10">
        <MenuButton
          class="hover:bg-gray-300 w-8 h-8 rounded-md grid place-content-center">
          <font-awesome-icon :icon="['fa', 'ellipsis-vertical']"/>
        </MenuButton>

        <transition
          enter-active-class="transition transform duration-100 ease-out"
          enter-from-class="opacity-0 scale-90"
          enter-to-class="opacity-100 scale-100"
          leave-active-class="transition transform duration-100 ease-in"
          leave-from-class="opacity-100 scale-100"
          leave-to-class="opacity-0 scale-90"
        >
          <MenuItems
            class="origin-top-left mt-2 focus:outline-none absolute left-0 bg-white overflow-hidden rounded-md shadow-lg border w-40">
            <MenuItem v-slot="{active}">
              <a href="#" :class="{'bg-gray-100': active}" class="block px-4 py-2 text-sm text-gray-700">Add
                Card</a>
            </MenuItem>
            <MenuItem v-slot="{active}">
              <a href="#" :class="{'bg-gray-100': active}" class="block px-4 py-2 text-sm text-red-600">Delete
                List
              </a>
            </MenuItem>
          </MenuItems>
        </transition>
      </Menu>
    </div>
    <div class="pb-3 flex flex-col overflow-hidden">
      <div ref="listRef" class="px-3 flex-1 overflow-y-auto">
        <Draggable
          v-model="cards"
          group="cards"
          item-key="id"
          class="space-y-3"
          tag="ul"
          drag-class="drag"
          ghost-class="ghost"
          @change="onChange"
        >
          <template #item="{element}">
            <CardListItem :card="element"/>
          </template>
        </Draggable>
      </div>
      <div class="px-3 mt-3">
        <CardListItemCreateForm :list="list" @created="onCardCreated()"/>
      </div>
    </div>
  </div>
</template>

<script setup>
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faEllipsisVertical} from "@fortawesome/free-solid-svg-icons";

import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue';
import {library} from "@fortawesome/fontawesome-svg-core";
import CardListItemCreateForm from '@/Pages/Boards/CardListItemCreateForm.vue';
import CardListItem from '@/Pages/Boards/CardListItem.vue';
import {ref, watch} from "vue";
import Draggable from 'vuedraggable';
import {router} from '@inertiajs/vue3'

library.add(faEllipsisVertical);

const props = defineProps({
  list: Object
})

const listRef = ref();
const cards = ref(props.list.cards);
watch(() => props.list.cards, (newCards) => cards.value = newCards);

function onCardCreated() {
  listRef.value.scrollTop = listRef.value.scrollHeight;
}

function onChange(e) {
  let item = e.added || e.moved;

  if (!item) return;

  let index = item.newIndex;
  let prevCard = cards.value[index - 1];
  let nextCard = cards.value[index + 1];
  let card = cards.value[index]

  let position = card.position;

  if (prevCard && nextCard) {
    position = (prevCard.position + nextCard.position) / 2
  } else if (prevCard) {
    position = prevCard.position + (prevCard.position / 2);
  } else if (nextCard) {
    position = nextCard.position / 2;
  }

  router.put(route('cards.move', {card: card.id}), {
    position: position,
    cardListId: props.list.id
  })
  console.log(e)
}
</script>

<style scoped>

</style>
