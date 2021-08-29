<template>
  <v-list dense nav>
    <v-subheader v-if="subheader">{{ subheader }}</v-subheader>
    <v-list-item-group v-model="selectedIndex" color="primary">
      <inertia-link
        as="v-list-item"
        v-for="(item, i) in items"
        :key="i"
        :href="
          !linkParam
            ? route(item.link)
            : route(route().current(), { [linkParam]: item.link })
        "
      >
        <v-list-item-icon v-if="item.icon">
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item-content>
      </inertia-link>
    </v-list-item-group>
  </v-list>
</template>

<script>
export default {
  props: ["subheader", "items", "linkParam", "active"],
  computed: {
    selectedIndex: {
      set() {},
      get: function () {
        return this.getIndex(this.items);
      },
    },
  },
  methods: {
    getIndex(list) {
      let index = [];
      for (let v in list) {
        if (list.hasOwnProperty(v)) index.push(list[v].link);
      }
      if (this.active) {
        return index.indexOf(this.active);
      } else if (this.linkParam) {
        return index.indexOf(route()["params"][this.linkParam]);
      } else {
        return index.indexOf(route().current());
      }
    },
  },
};
</script>
