<template>
    <tr>
        <td v-text="data.original_filename"></td>
        <td>{{ data.created_at }} UTC</td>
        <td>{{ data.sent ? 'Да' : 'Нет' }}</td>
        <td>{{ data.reviewed ? 'Да' : 'Нет' }}</td>

        <td>
            <a v-show="! data.reviewed" href="">Удалить</a>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['data']
}
</script>
