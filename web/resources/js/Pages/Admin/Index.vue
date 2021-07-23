<template>
  <admin-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>
    <v-card flat bordered>
      <v-card-title> {{ app_name }}</v-card-title>
      <danger-button> Delete Account </danger-button>

      <v-card-text>
        <v-simple-table>
          <template v-slot:default>
            <tbody>
              <tr v-for="env in envs" :key="env.name">
                <td>{{ env.name }}</td>
                <td>{{ env.value }}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table></v-card-text
      >
    </v-card>
  </admin-layout>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout";
import DangerButton from "@/Components/DangerButton";

export default {
  components: {
    AdminLayout,
    DangerButton,
  },
  props: {
    envs: {
      type: Array,
    },
    app_name: String,
  },
};
</script>
