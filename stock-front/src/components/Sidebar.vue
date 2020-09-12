<template>
  <div class="hidden">
    <vs-sidebar
      absolute
      v-model="active"
      :open="activeSidebar"
    >
      <span class="mb-large"></span>

      <vs-sidebar-item id="Filters">
        Filters
        <vs-button @click="activeSidebar = false" flat icon class="close-sidebar">
          <i class='bx bx-x'></i>
        </vs-button>
      </vs-sidebar-item>

      <div class="filter">
        <div class="center content-inputs">
          <vs-row :w="12" :justify="'center'" v-for="(filter, key) in getFilters()" :key="key">
            <vs-input
              type="text"
              v-model="filters[filter].value"
              :label="filter"
            />

            <span class="mr-small"></span>

            <condition-stock
              v-bind:condition="filters[filter].condition"
              v-on:select="filters[filter].condition = $event"
            ></condition-stock>
          </vs-row>
        </div>
      </div>

      <template>
        <vs-row justify="space-between">
            <vs-button
              transparent
              :active="true"
              @click="filter()"
            >
              Apply
            </vs-button>
            <vs-button
              transparent
              @click="clear()"
            >
              Clear
            </vs-button>
        </vs-row>
      </template>
    </vs-sidebar>
  </div>
</template>
<script>
import ConditionStock from './ConditionStock';

export default {
  components: {
    ConditionStock,
  },
  props: {
    activeSidebar: {
      type: Boolean,
      default: false,
    },
  },
  data:() => ({
    active: 'Filters',
    filters: [],
    lastFilters: [],
    url: '',
  }),
  methods: {
    getFilters() {
      return [
        'symbol',
        'open',
        'high',
        'low',
        'close',
        'last',
        'prevClose',
        'totalTradeQuantity',
        'totalTradeVolume',
        'totalTrades',

        'change',
        'changeInPercentage',
        'jump',
        'jumpInPercentage',
      ];
    },
    filter() {
      this.url = '';
      for (const [field, filter] of Object.entries(this.filters)) {
        if (filter.value) {
          this.url += ('&' + field + '=' +  filter.value + (filter.condition ? (',' + filter.condition) : ''));
        }
      }
      window.location = '?' + this.url;
    },
    clear() {
      this.url = '';
      window.location = '?';
    }
  },
  created() {
    this.lastFilters = window.stockVueData.filters || [];
    this.getFilters().forEach(filter => {
      this.filters[filter] = this.lastFilters[filter] || {
        condition: '',
        value: '',
      };
    });
  },
}
</script>


