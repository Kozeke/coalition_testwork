<script setup>
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue';

</script>

<template>
    <div>
      <div class="flex flex-col h-screen">
          <nav class="shrink-0 flex justify-between bg-white px-4 py-3">
            <a class="text-2xl font-black tracking-tight" :href="route('boards')">trello</a>
            <div class="flex items-center">
              <NavLink href="#">My boards</NavLink>
              <Menu as="div" class="relative z-10">
                <MenuButton
                  class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 rounded-full">
                  <img class="h-9 w-9 inline rounded-full"
                       :src="$page.props.auth.user.avatar_url"
                       :alt="$page.props.auth.user.name">

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
                    <MenuItem v-slot="{active}">
                      <Link :class="{'bg-gray-100': active}" :href="route('logout')" method="post" as="button" class="w-full text-left block px-4 py-2 text-sm text-gray-700">Log
                        out</Link>
                    </MenuItem>
                  </MenuItems>
                </transition>
              </Menu>

            </div>
          </nav>


            <!-- Page Content -->
        <main class="flex-1 overflow-hidden">
                <slot />
            </main>
        </div>
    </div>
</template>
