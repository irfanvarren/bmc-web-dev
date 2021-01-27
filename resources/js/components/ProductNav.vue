<template>
  <!-- Renderless component that exposes 2 arrays based on the array you pass in the nav prop. -->
  <VueResponsiveMenu
    #default="{ menuItems, moreMenuItems}"
    :nav="this.nav"
    label="name"
    :maxCharacters="85"
  >
    <ul>
      <!-- Default menu -->
      <li v-for="item in menuItems" :key="item.id">
        <a :href="item.href">
          {{ item.name }}
        </a>
      </li>
 
      <!-- More menu with the items that didn't fit -->
      <li v-if="moreMenuItems.length" class="more">
        <button type="button">
          {{ menuItems.length === 0 ? '☰' : 'Selebihnya &or;' }}
        </button>
        <ul class="more-dropdown">
          <li v-for="item in moreMenuItems" :key="item.id">
            <a :href="item.href">
              {{ item.name }}
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </VueResponsiveMenu>
</template>
 
<script>
  import VueResponsiveMenu from 'vue-responsive-menu'

  export default {
    components: {
      VueResponsiveMenu
    },
    props : ['nav'],
    data() {
      return {
        mainMenu:{
          items : [
          { label: 'This', id: 1, link: '#1' },
          { label: 'is an', id: 2, link: '#2' },
          { label: 'example', id: 3, link: '#3' },
          { label: 'navigation', id: 4, link: '#4' },
          { label: 'with many', id: 5, link: '#5' },
          { label: 'many', id: 6, link: '#5' },
          { label: 'many', id: 7, link: '#5' },
          { label: 'many', id: 8, link: '#5' },
          { label: 'items', id: 9, link: '#6' }
        ]
        },
        navigation: [
          { label: 'This', id: 1, link: '#1' },
          { label: 'is an', id: 2, link: '#2' },
          { label: 'example', id: 3, link: '#3' },
          { label: 'navigation', id: 4, link: '#4' },
          { label: 'with many', id: 5, link: '#5' },
          { label: 'many', id: 6, link: '#5' },
          { label: 'many', id: 7, link: '#5' },
          { label: 'many', id: 8, link: '#5' },
          { label: 'items', id: 9, link: '#6' }
        ]
      }
    }
  }
</script> 