<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  data:() => ({
    chartDummy: {
      labels: ['2 June', '3 June 2020', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '',
        data: [12, 19, 3, 5, -2, 3],
        dataInPercentage: [12, 19, 3, 5, -2, 3],
        borderWidth: 1,
        backgroundColor: function(context) {
          const index = context.dataIndex;
          const value = context.dataset.data[index];
          return value < 0 ? 'red' : 'green';
        },
      }],
    },
    options: {
      title: {
        display: false,
        text: 'Custom Chart Title'
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            let label = data.datasets[tooltipItem.datasetIndex].label || '';

            if (label) {
              label += ': ';
            }
            label += Math.round(tooltipItem.yLabel * 100) / 100;
            label += ' / ' + this._data.datasets[tooltipItem.datasetIndex].dataInPercentage[tooltipItem.index] + '%';
            return label;
          }
        }
      },
    },
  }),
  props: {
    chartdata: {
      type: Object,
      default: null
    },
  },
  methods: {
    renderChartFromComponent() {
      this.chartDummy.labels = this.chartdata.labels;
      this.chartDummy.datasets[0].data = this.chartdata.data;
      this.chartDummy.datasets[0].dataInPercentage = this.chartdata.dataInPercentage;
      this.renderChart(this.chartDummy, this.options)
    },
  },
  watch: {
    chartdata () {
      this.renderChartFromComponent();
    }
  },
  mounted () {
    this.renderChartFromComponent();
  },
}
</script>
