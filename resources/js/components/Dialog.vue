<template>
  <span>
    <span @click.stop="dialog = true" style="cursor: pointer;">
      <slot></slot>
    </span>
    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="290">
        <v-card>
          <v-card-title class="title">{{ title }}</v-card-title>

          <v-card-text class="body-1" v-if="message">{{ message }}</v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn v-if="labelNo" text :color="colorNo ? colorNo : 'gray'  +' darken-1'" @click="dialog = false">{{ labelNo }}</v-btn>

            <v-btn v-if="labelYes" dark :color="colorYes ? colorYes : 'green'  +' darken-1'" @click="dialog = false;callMethod(method, items)">{{ labelYes }}</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </span>
</template>

<script>
export default {
  name: "Dialog",
  props: ['title', 'message', 'labelNo', 'labelYes', 'colorNo', 'colorYes', 'method', 'items'],
  data: () => ({
    dialog: false
  }),
  methods: {
    callMethod: function(method, items){
     this.$root.$emit(method, items)
    }
  }
};
</script>