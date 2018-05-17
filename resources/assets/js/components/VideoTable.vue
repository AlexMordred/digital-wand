<template>
    <div>
        <div class="form-check">
            <input class="form-check-input"
                type="checkbox"
                value=""
                id="sent"
                autocomplete="off"
                v-model="sent">
            
            <label class="form-check-label" for="sent">
                Отправлено
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input"
                type="checkbox"
                value=""
                id="reviewed"
                autocomplete="off"
                v-model="reviewed">
            
            <label class="form-check-label" for="reviewed">
                Отмодерировано
            </label>
        </div>

        <table class="table stripped">
            <thead>
                <th>Оригинальное название файла</th>
                <th>Дата загрузки</th>
                <th>Отправлено</th>
                <th>Отмодерировано</th>
                <th></th>
            </thead>

            <tbody v-if="videos.length">
                <tr v-for="(video, index) in videos"
                    :key="index"
                    is="video-table-row" :data="video"
                    @deleted="fetchData"></tr>
            </tbody>

            <tbody v-else>
                <tr v-show="! fetching">
                    <td>
                        Пусто.
                    </td>
                </tr>
            </tbody>
        </table>

        <vue-paginator :data="data"
            @pageChanged="onPageChanged"></vue-paginator>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: [],
            videos: [],
            fetching: true,

            sent: false,
            reviewed: false,
            page: 1,
        }
    },

    computed: {
        endpoint() {
            let sent = this.sent ? '1' : '0';
            let reviewed = this.reviewed ? '1' : '0';

            return `/admin/videos?page=${this.page}&sent=${sent}&reviewed=${reviewed}`;
        }
    },

    watch: {
        sent() {
            this.fetchData();
        },

        reviewed() {
            this.fetchData();
        }
    },

    created() {
        this.fetchData();
    },

    methods: {
        fetchData() {
            axios.get(this.endpoint)
                .then(({ data }) => {
                    this.data = data;
                    this.videos = data.data;

                    this.fetching = false;
                });
        },

        onPageChanged(page) {
            this.page = page;

            this.fetchData();
        }
    }
}
</script>
