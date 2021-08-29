<template>
  <v-card class="mx-auto" flat color="rgba(0,0,255,0)">
    <v-list color="rgba(0,0,255,0)" dense>
      <v-subheader>REPORTS</v-subheader>
      <v-list-item-group v-model="selectedItem" color="primary">
        <inertia-link
          as="v-list-item"
          v-for="(item, i) in items"
          :key="i"
          :href="route(item.link)"
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
  </v-card>
</template>
<script>
export default {
  data: () => ({
    selectedItem: null,
    items: [
      { title: "ホーム", icon: "mdi-home", link: "home" },
      { title: "投稿", icon: "mdi-pencil", link: "admin" },
      { title: "検索", icon: "mdi-magnify", link: "admin" },
      { title: "メッセージ", icon: "mdi-message", link: "admin" },
      { title: "設定", icon: "mdi-cog", link: "setting.profile" },
    ],
  }),
  created() {
    //選択している項目を取得
    this.selectedItem = 1;
    const current = route().current();
    if (current == "home") {
      this.selectedItem = 0;
    } else if (!current.indexOf("admin")) {
      this.selectedItem = 1;
    } else if (!current.indexOf("setting.account")) {
      this.selectedItem = 2;
    }
  },
};
</script>
