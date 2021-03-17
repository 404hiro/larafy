<template>
  <admin-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Log-Viewer
      </h2>
    </template>
    <v-row>
      <v-col cols="9">
        <v-card flat bordered class="mb-3">
          <v-card-title>{{ fileName }}</v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            <v-simple-table>
              <thead>
                <tr>
                  <th class="text-left">Level</th>
                  <th class="text-left">Env</th>
                  <th class="text-left">Datetime</th>
                  <th class="text-left">Message</th>
                  <th class="text-left">Except</th>
                </tr>
              </thead>
              <tbody v-for="(item, i) in logData" :key="i">
                <tr>
                  <td>
                    <v-chip small :color="levelColor(item.level_name)">
                      {{ item.level_name }}
                    </v-chip>
                  </td>
                  <td>{{ item.channel }}</td>
                  <td>{{ moment(item.datetime) }}</td>
                  <td>{{ item.message }}</td>
                  <td>
                    <v-btn
                      fab
                      dark
                      depressed
                      x-small
                      color="primary"
                      @click.stop="onClickBtn(item.extra)"
                    >
                      <v-icon> mdi-alert-circle-outline </v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </v-simple-table>
            <v-dialog
              v-model="dialog"
              activator
              scrollable
              max-width="600px"
              v-if="except"
            >
              <v-card>
                <v-card-text
                  ><v-simple-table>
                    <template v-slot:default>
                      <tbody>
                        <tr v-for="(value, i) in except" :key="i">
                          <th>{{ i }}</th>
                          <td>{{ value }}</td>
                        </tr>
                      </tbody>
                    </template>
                  </v-simple-table>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text @click="dialog = false"> CLOSE </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="3">
        <v-card flat bordered class="mb-3">
          <v-toolbar color="rgb(103, 119, 239)" dark flat dense>
            <v-toolbar-title>Files</v-toolbar-title>
          </v-toolbar>
          <list-link
            v-if="route()['params']['file']"
            :items="logFiles"
            linkParam="file"
          />
          <list-link
            v-else
            :items="logFiles"
            :active="fileName"
            linkParam="file"
          />
        </v-card>
      </v-col>
    </v-row>
  </admin-layout>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout";
import ListLink from "@/Components/ListLink";
export default {
  components: {
    ListLink,
    AdminLayout,
  },
  props: {
    fileName: String,
    logFiles: { type: Array },
    logData: { type: Array },
  },
  data: () => ({
    dialog: false,
    except: null,
  }),
  methods: {
    moment(date) {
      var moment = require("moment");
      return moment(date).format("YYYY-MM-DD HH:mm:SS");
    },
    levelColor(level) {
      var color = "gray";
      if (level == "ERROR") {
        color = "error";
      } else if (level == "INFO") {
        color = "info";
      } else if (level == "WARNING") {
        color = "warning";
      }
      return color;
    },
    onClickBtn(except) {
      this.except = except;
      this.dialog = true;
    },
  },
};
</script>
