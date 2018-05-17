<template>
    <nav aria-label="Page navigation example" v-show="pagesTotal > 1">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link"
                    href="#"
                    :disabled="page <= 1 || loading"
                    @click.prevent="prevPage">Назад</a>
            </li>

            <li class="page-item">
                <a class="page-link"
                    href="#"
                    :disabled="page >= pagesTotal || loading"
                    @click.prevent="nextPage">Вперёд</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ['data'],

    data() {
        return {
            page: this.data.current_page,
            pagesTotal: 1,
            loading: false
        };
    },

    watch: {
        data () {
            this.pagesTotal = this.data.last_page;

            if (this.data.current_page > this.pagesTotal) {
                this.setPage(this.pagesTotal);
            } else {
                if (this.page != this.data.current_page) {
                    window.scrollTo(0, 0);
                }

                this.page = this.data.current_page;
                this.loading = false;
            }
        }
    },

    methods: {
        nextPage () {
            if (this.page < this.pagesTotal) {
                this.setPage(this.page + 1);
            }
        },

        prevPage () {
            if (this.page > 1) {
                this.setPage(this.page - 1);
            }
        },

        setPage (page) {
            if (this.page != page) {
                this.loading = true;

                this.$emit('pageChanged', page);
            }
        },
    }
}
</script>
