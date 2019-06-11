<template>
    <table class="table table-hover">
        <tbody>
        <tr>
            <td v-for="title in table_title">{{ title }}</td>
        </tr>
        <tr v-for="row in table_data">
            <td v-for="td in row">{{ td }}</td>
        </tr>
        <tbody>
    </table>
</template>

<script>
    export default {
        name: "table-list",
        props: {
            table_data:Array,
            table_title:Array
        },
    }
</script>

<style scoped>

</style>