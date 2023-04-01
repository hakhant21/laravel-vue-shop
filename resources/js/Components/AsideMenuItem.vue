<script setup>
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { useStyleStore } from "@/Stores/style.js";
import { mdiMinus, mdiPlus } from "@mdi/js";
import BaseIcon from "@/Components/BaseIcon.vue";
import AsideMenuList from "@/Components/AsideMenuList.vue";

const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
  isDropdownList: Boolean,
});

const emit = defineEmits(["menu-click"]);

const styleStore = useStyleStore();

const hasColor = computed(() => props.item && props.item.color);

const asideMenuItemActiveStyle = computed(() =>
  hasColor.value ? "" : styleStore.asideMenuItemActiveStyle
);

const isDropdownActive = ref(false);

const hasDropdown = computed(() => !!props.item.menu);

const itemHref = computed(() =>
  props.item.route ? route(props.item.route) : props.item.href
);

// Add activeInactiveStyle
const activeInactiveStyle = computed(() =>
  props.item.route && route().current(props.item.route)
    ? styleStore.asideMenuItemActiveStyle
    : ""
);


const menuClick = (event) => {
  emit("menu-click", event, props.item);

  if (hasDropdown.value) {
    isDropdownActive.value = !isDropdownActive.value;
  }
};
</script>

<template>
  <li>
    <component
      :is="item.route ? Link : 'a'"
      :to="item.to ?? null"
      :href="itemHref ?? null"
      :target="item.target ?? null"
      class="flex cursor-pointer"
      :class="activeInactiveStyle"
      @click="menuClick"
    >
      <BaseIcon
        v-if="item.icon"
        :path="item.icon"
        class="flex-none"
        :class="activeInactiveStyle"
        w="w-16"
        :size="18"
      />
      <span
        class="grow text-ellipsis line-clamp-1"
        :class="[
          { 'pr-12': !hasDropdown },
          activeInactiveStyle,
        ]"
        >{{ item.label }}</span
      >
      <BaseIcon
        v-if="hasDropdown"
        :path="isDropdownActive ? mdiMinus : mdiPlus"
        class="flex-none"
        :class="activeInactiveStyle"
        w="w-12"
      />
    </component>
    <AsideMenuList
      v-if="hasDropdown"
      :menu="item.menu"
      :class="[
        styleStore.asideMenuDropdownStyle,
        isDropdownActive ? 'block dark:bg-slate-800/50' : 'hidden',
      ]"
      is-dropdown-list
    />
  </li>
</template>
