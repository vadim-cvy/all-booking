<jbk-field
  class="jbk-filter-instance__global-stettings__label"
  label="State"
>
  <template #default="{ inputId }">
    <select
      :id="inputId"
      v-model="filterInstance.state"
    >
      <option value="enabled">Visible for users</option>
      <option value="under_development">Under development (is hidden for users but related post metaboxes still appear)</option>
      <option value="disabled">Disabled</option>
    </select>
  </template>
</jbk-field>