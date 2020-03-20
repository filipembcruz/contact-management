<template>
  <div>
    <v-alert dismissible type="success" border="left" elevation="2" v-show="message">{{ message }}</v-alert>
    <v-data-table
      :headers="headers"
      :items="rows"
      :search="search"
      sort-by="Sended At"
      class="elevation-1"
      style="width: 100%"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>{{ title }}</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-btn
            v-show="!guest"
            color="success"
            dark
            class="mb-2"
            :href="create"
            style="text-decoration: none"
          >
            <v-icon size="20" class="mr-2">mdi-plus-circle-outline</v-icon>ADD NEW
          </v-btn>
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-toolbar>
      </template>
      <template v-slot:item.action="{ item }">
        <v-icon size="20" class="mr-2" @click="showItem(item)">mdi-eye</v-icon>
        <v-icon v-show="!guest" size="20" class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <DialogCustom
          message="Are you sure you want to delete this contact?"
          labelNo="Cancel"
          labelYes="Delete"
          colorYes="red"
          method="deleteItem"
          :items="item"
        >
          <v-icon v-show="!guest" size="20">mdi-trash-can</v-icon>
        </DialogCustom>
      </template>
      <template v-slot:no-data>
        <span>There are no registered contacts.</span>
        <v-icon @click="initialize">mdi-refresh-circle</v-icon>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import DialogCustom from "./Dialog.vue";

export default {
  name: "DataTables",
  props: ["title", "collection", "url", "token", "guest"],
  components: {
    DialogCustom
  },
  data: () => ({
    search: "",
    create: "",
    message: "",
    headers: [
      {
        text: "id",
        align: " d-none",
        sortable: false,
        value: "id"
      },
      {
        text: "Full Name",
        align: "start",
        sortable: true,
        value: "name"
      },
      {
        text: "Contact",
        align: "center",
        sortable: true,
        value: "contact"
      },
      {
        text: "Email",
        align: "center",
        sortable: true,
        value: "email"
      },
      {
        text: "Actions",
        align: "center",
        sortable: false,
        value: "action"
      }
    ],
    rows: []
  }),

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  mounted() {
    this.$root.$on("deleteItem", item => {
      let self = this;
      $.ajax({
        type: "POST",
        url: `${this.url}/${item.id}`,
        data: { _method: "delete", _token: this.token },
        success: function() {
          const index = self.rows.indexOf(item);
          self.rows.splice(index, 1);
          self.message = "Contact deleted!";
        },
        error: function(data, textStatus, errorThrown) {
          console.log(data);
        }
      });
    });
  },

  methods: {
    initialize() {
      this.rows = this.collection;
      this.create = `${this.url}/create`;
    },

    editItem(item) {
      window.location.href = `${this.url}/${item.id}/edit`;
    },

    showItem(item) {
      window.location.href = `${this.url}/${item.id}`;
    },

    close() {
      this.dialog = false;
    }
  }
};
</script>
