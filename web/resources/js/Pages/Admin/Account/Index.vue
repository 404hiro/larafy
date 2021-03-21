<template>
  <admin-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Account</h2>
    </template>
    <v-card flat bordered>
      <v-card-title>
        Account List
        <v-spacer></v-spacer>
        <v-pagination
          v-model="page"
          :length="accounts.last_page"
          :total-visible="5"
          circle
          @input="getNumber"
        >
        </v-pagination>
      </v-card-title>
      <v-card-text>
        <v-simple-table bordered>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Name</th>
                <th class="text-left">E-Mail</th>
                <th class="text-left">Role</th>
                <th class="text-left">Created at</th>
                <th class="text-left">Updated at</th>
                <th class="text-left">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="account in accounts.data" :key="account.id">
                <td>{{ account.name }}</td>
                <td>{{ account.email }}</td>
                <td>{{ account.role_title }}</td>
                <td>{{ moment(account.created_at) }}</td>
                <td>{{ moment(account.updated_at) }}</td>
                <td>
                  <inertia-link
                    as="v-btn"
                    :href="route('admin.account.edit', { id: account.id })"
                    icon
                    color="primary"
                    dark
                  >
                    <v-icon> mdi-pencil </v-icon>
                  </inertia-link>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <div>
          <v-pagination
            v-model="page"
            :length="accounts.last_page"
            :total-visible="5"
            circle
            @input="getNumber"
          >
          </v-pagination>
        </div>
      </v-card-actions>
    </v-card>
  </admin-layout>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout";

export default {
  components: {
    AdminLayout,
  },
  props: ["accounts"],

  computed: {
    page: {
      set() {},
      get: function () {
        return this.accounts.current_page;
      },
    },
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
