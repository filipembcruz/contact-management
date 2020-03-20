<template>
  <div v-show="status">
    <!-- Desktop Menu -->
    <div style="background:#32b4e4">
      <v-container class="pa-0" style="max-width:70%">
        <v-toolbar flat v-if="window.width > 800" class="toolbar-custom" color="#32b4e4" dark>
          <v-toolbar-title class="pa-0" :v-text="title">{{title}}</v-toolbar-title>

          <v-spacer></v-spacer>

          <v-toolbar-items>
            <v-btn
              text
              :href="link.url"
              :id="link.id ? link.id : 'btn_'+key"
              v-for="(link, key) in links"
              v-bind:key="key"
              v-text="link.label"
            ></v-btn>
          </v-toolbar-items>
        </v-toolbar>
      </v-container>
    </div>

    <!-- Mobile Menu -->
    <v-navigation-drawer v-if="window.width <= 800" v-model="drawer" app clipped>
      <v-list dense>
        <v-list-item link v-for="(link, key) in links" v-bind:key="key" :id="link.id ? link.id : 'btn_'+key" :href="link.url">
          <v-list-item-action>
            <v-icon v-text="link.icon"></v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="link.label"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar v-if="window.width <= 800" app clipped-left color="#32b4e4" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title class="logo-title" :v-text="titleMobile"></v-toolbar-title>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  props: {
    url: String,
    menu: String
  },
  data: function() {
    return {
      status: true,
      window: {
        width: 0,
        height: 0
      },
      title: "Alfasoft",
      titleMobile: "Alfasoft",
      drawer: null,
      links: []
    };
  },
  mounted() {
    $("#make-logout").click(function(){
      $('#logout-form').submit();
    })
  },
  created() {
    window.addEventListener("resize", this.handleResize);
    this.handleResize();
    if (this.menu == "hasLogin") {
      this.links = [
        {
          icon: "mdi-contacts",
          label: "Contact",
          url: this.url
        },
        {
          icon: "mdi-logout-variant",
          label: "Logout",
          url: "",
          id: "make-logout"
        }
      ];
      this.status = true;
    } else if (this.menu == "noLogin") {
      this.links = [
        {
          icon: "mdi-contacts",
          label: "Contact",
          url: this.url
        },
        {
          icon: "mdi-login-variant",
          label: "Login",
          url: this.url + "/login",
        },
        {
          icon: "mdi-account-plus",
          label: "Register",
          url: this.url + "/register"
        }
      ];
      this.status = true;
    } else {
      this.status = false;
    }
  },
  destroyed() {
    window.removeEventListener("resize", this.handleResize);
  },
  methods: {
    handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
    },
  }
};
</script>

<style>
.v-navigation-drawer,
.v-overlay {
  z-index: 2 !important;
}
.v-navigation-drawer--clipped {
  top: 55px !important;
  z-index: 1;
}
.v-list-item__content {
  text-align: left;
}
</style>