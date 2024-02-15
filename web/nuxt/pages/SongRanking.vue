<template>
  <div>
    <Chart :chartData="chartData" :options="chartOptions" />
  </div>
</template>

<script>
import Chart from '@/components/Chart.vue';

export default {
  components: {
    Chart,
  },
  data() {
    return {
      chartData: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
        datasets: [
          {
            label: 'Ventas mensuales',
            data: [65, 59, 80, 81, 56],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
          },
        ],
      },
      chartOptions: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    };
  },
};
</script>