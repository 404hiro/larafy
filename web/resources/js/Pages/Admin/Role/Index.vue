<template>
  <admin-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        権限管理
      </h2>
    </template>
    <v-card flat bordered>
      <v-card-title>
        アカウント管理
        <v-spacer></v-spacer>
      </v-card-title>
      <v-card-text>
        <v-simple-table bordered>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Title</th>
                <th class="text-left">Role</th>
                <th class="text-left">Created at</th>
                <th class="text-left">Updated at</th>
                <th class="text-left">Users</th>
                <th class="text-left">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="role in roles" :key="role.id">
                <td>{{ role.title }}</td>
                <td>{{ role.role }}</td>
                <td>{{ moment(role.created_at) }}</td>
                <td>{{ moment(role.updated_at) }}</td>
                <td>{{ role.users_count }}人</td>
                <td>
                  <v-icon> mdi-pencil </v-icon>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>
    </v-card>
  </admin-layout>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout";

export default {
  components: {
    AdminLayout,
  },
  props: ["roles"],
  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    moment(date) {
      var moment = require("moment");
      return moment(date).format("YYYY-MM-DD HH:mm:SS");
    },
    getNumber: function (number) {
      this.$inertia.get("", { page: number });
    },
  },
};
</script>
