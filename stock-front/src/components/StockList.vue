<template>
  <vs-row :w="12">
    <vs-table>
      <!--
      <template #header>
        <vs-input v-model="search" border placeholder="Search" />
      </template> -->
      <template #thead>
        <vs-tr>
          <vs-th sort @click="stocks = $vs.sortData($event ,stocks, 'symbol')">
            Symbol
          </vs-th>
          <vs-th>
            Chart
          </vs-th>
          <vs-th sort @click="stocks = $vs.sortData($event ,stocks, 'change')">
            Change Rs
          </vs-th>
          <vs-th sort @click="stocks = $vs.sortData($event ,stocks, 'changeInPercentage')">
            Change In Percentage
          </vs-th>
          <vs-th sort @click="stocks = $vs.sortData($event ,stocks, 'initialPrice')">
            Initial Price
          </vs-th>
          <vs-th sort @click="stocks = $vs.sortData($event ,stocks, 'lastPrice')">
            Last Price
          </vs-th>
        </vs-tr>
      </template>
      <template #tbody>
        <vs-tr
          v-for="(tr, i) in $vs.getPage(stocks, page, max)"
          :key="i"
          :data="tr"
          class="text-left"
        >
          <vs-td>
            {{ tr.symbol }}
          </vs-td>
          <vs-td>
            <div
              class="chart-container"
            >
              <bar-chart
                :chartdata="tr.chartDataWithDates"
              ></bar-chart>
            </div>
          </vs-td>
          <vs-td>
            {{ tr.change }}
          </vs-td>
          <vs-td>
            {{ tr.changeInPercentage }} %
          </vs-td>
          <vs-td>
            {{ tr.initialPrice }}
          </vs-td>
          <vs-td>
            {{ tr.lastPrice }}
          </vs-td>
        </vs-tr>
      </template>
      <template #footer>
        <vs-pagination v-model="page" :color="color" :length="$vs.getLength(stocks, max)" />
      </template>
    </vs-table>
  </vs-row>
</template>

<script>
import BarChart from './BarChart'

export default {
  components: {
    BarChart,
  },
  data:() => ({
    search: '',
    page: 1,
    max: 10,
    color: '#10b0b4',
    stocks: window.stockVueData.stocks,
  }),
};
</script>

