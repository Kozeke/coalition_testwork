<script setup>
import {library} from '@fortawesome/fontawesome-svg-core'
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faEllipsis} from "@fortawesome/free-solid-svg-icons";

import Authenticated from "@/Layouts/AuthenticatedLayout.vue";
import BoardNameForm from "@/Pages/Boards/BoardNameForm.vue";
import CardListCreateForm from "@/Pages/Boards/CardListCreateForm.vue";
import CardList from "@/Pages/Boards/CardList.vue";

library.add(faEllipsis);

import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue';

const props = defineProps({
  board: Object,
})
</script>
<template>
  <Authenticated>
    <div class="flex flex-col h-full bg-blue-600">
      <div class="shrink-0 flex flex-wrap justify-between items-center p-4">
        <BoardNameForm :project="board"/>
        <div>
          <Menu as="div" class="relative z-10">
            <MenuButton
              class="inline-flex items-center bg-white/10 hover:bg-white/20 px-3 py-2 font-medium text-sm text-white rounded-md">
              <font-awesome-icon :icon="['fa', 'ellipsis']"/>

              <span class="ml-1">Settings</span>

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
                class="origin-top-right mt-2 focus:outline-none absolute right-0 bg-white overflow-hidden rounded-md shadow-lg border w-48">
                <MenuItem v-slot="{active}">
                  <a href="#" :class="{'bg-gray-100': active}" class="block px-4 py-2 text-sm text-gray-700">My
                    Profile</a>
                </MenuItem>
                <MenuItem v-slot="{active, disabled}" disabled>
                  <a href="#" :class="{'bg-gray-100': active, 'opacity-40': disabled}"
                     class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                </MenuItem>
                <MenuItem v-slot="{active}">
                  <a href="#" :class="{'bg-gray-100': active}" class="block px-4 py-2 text-sm text-gray-700">Help</a>
                </MenuItem>
                <MenuItem v-slot="{active}">
                  <a href="#" :class="{'bg-gray-100': active}" class="block px-4 py-2 text-sm text-gray-700">Log
                    out</a>
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
      <div class="flex-1 overflow-x-auto">
        <div class="inline-flex h-full items-start px-4 pb-4 space-x-4">
          <CardList v-for="list in board.lists" :key="list.id" :list="list"
                    class="w-72 bg-gray-200 max-h-full flex flex-col rounded-md"/>
          <div class="w-72">
            <CardListCreateForm :board="props.board"/>
          </div>
        </div>
      </div>
    </div>
  </Authenticated>
</template>

<style scoped>

</style>
