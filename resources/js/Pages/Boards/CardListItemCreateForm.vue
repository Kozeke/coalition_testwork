<template>
  <form @keydown.esc="store.value.listCreatingCardId=null" @submit.prevent="onSubmit()" v-if="isShowingForm">
    <textarea v-model="form.title" ref="inputNameRef" type="text" placeholder="Enter card title..." rows="3"
              @keydown.enter.prevent="onSubmit()"
              class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring-blue-400">
    </textarea>
    <div class="mt-2 space-x-2">
      <button
        type="submit"
        class="px-4 py-2 text-sm font-medium text-white bg-rose-600 hover:bg-rose-500 rounded-md shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none">
        Add card
      </button>
      <button
        type="button"
        @click="store.value.listCreatingCardId = null"
        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-black rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none">
        Cancel
      </button>
    </div>
  </form>
  <button
    v-if="!isShowingForm"
    @click="showForm()"
    class="flex items-center p-2 text-sm font-medium text-gray-600 hover:text-black hover:bg-gray-300 w-full rounded-md">
    <PlusIcon class="w-5 h-5"></PlusIcon>
    <span class="ml-1">Add card</span>
  </button>
</template>

<script setup>
import {PlusIcon} from '@heroicons/vue/20/solid';
import {nextTick, ref, computed} from "vue";
import {useForm} from "@inertiajs/vue3";
import {store} from "@/store";

const isShowingForm = computed(() => props.list.id === store.value.listCreatingCardId);
const inputNameRef = ref();
const props = defineProps({
  list: Object
})

const emit = defineEmits(['created']);

const form = useForm({
  title: '',
  card_list_id: props.list.id,
  board_id: props.list.board_id
})

async function showForm() {
  store.value.listCreatingCardId = props.list.id
  isShowingForm.value = true;
  await nextTick();
  inputNameRef.value.focus();
}

function onSubmit() {
  form.post(route('cards.store'), {
    onSuccess: () => {
      form.reset();
      inputNameRef.value.focus();
      emit('created');
    }
  })
}
</script>

<style scoped>

</style>
