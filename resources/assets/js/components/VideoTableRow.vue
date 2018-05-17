<template>
    <tr>
        <td v-text="data.original_filename"></td>
        <td>{{ data.created_at }} UTC</td>
        <td>{{ data.sent ? 'Да' : 'Нет' }}</td>
        <td>{{ data.reviewed ? 'Да' : 'Нет' }}</td>

        <td>
            <a v-show="! data.reviewed"
                href=""
                @click.prevent="deleteVideo">Удалить</a>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['data'],

    methods: {
        deleteVideo() {
            axios.delete(`/admin/videos/${this.data.id}`);

            this.$emit('deleted');
        }
    }
}
</script>
