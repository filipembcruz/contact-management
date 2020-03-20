<template>
  <v-text-field v-if="mask" :name="cname" :rules="rules" :label="clabel" :value="cvalue"  v-mask="`${mask}`"></v-text-field>
  <v-text-field v-else :name="cname" :rules="rules" :value="cvalue" :label="clabel"></v-text-field>
</template>

<script>
import { mask } from "vue-the-mask";

export default {
  name: "customInput",
  directives: {
    mask
  },
  props: ["rules", "cname", "clabel", "mask", "cvalue"]
};
</script>