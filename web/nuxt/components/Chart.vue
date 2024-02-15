<template>
    <div>
      <canvas ref="chart"></canvas>
    </div>
  </template>
  
  <script>
  import { Chart, BarController, CategoryScale, LinearScale } from 'chart.js';
  
  Chart.register(BarController, CategoryScale, LinearScale);
  
  export default {
    props: ['chartData', 'options'],
    mounted() {
      new Chart(this.$refs.chart.getContext('2d'), {
        type: 'bar',
        data: this.chartData,
        options: this.options,
      });
    },
  };
  </script>