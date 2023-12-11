<template>
  
 <nav aria-label="Page navigation example" v-if="type">
                    <ul class="pagination justify-content-end">
                        <li
                            class="page-item"
                            :class="{ disabled: currentPage === 1 }"
                            @click="prevPage(merchants.meta['prev_page_url'])"
                        >
                            <a class="page-link" tabindex="-1">Previous</a>
                        </li>

                        <li
                            v-for="(pageNumber, i) in totalPage"
                            class="page-item"
                            :class="{ active: currentPage === pageNumber }"
                        >
                            <a
                                class="page-link"
                                @click="setCurrentPage(pageNumber)"
                                v-if="
                                    i + 1 === 1 ||
                                    (currentPage - 3 <= i &&
                                        currentPage + 3 >= i) ||
                                    i === currentPage ||
                                    i + 1 === totalPage
                                "
                                :class="{
                                    disabled: currentPage === pageNumber,
                                    last:
                                        pageNumber === totalPage - 1 &&
                                        Math.abs(pageNumber - currentPage) > 3,
                                    first:
                                        pageNumber === 0 &&
                                        Math.abs(pageNumber - currentPage) > 3,
                                }"
                            >
                                {{ pageNumber + "A" }}
                            </a>
                            <a
                                class="page-link"
                                v-else-if="
                                    i === currentPage - (3 + 1) ||
                                    i === currentPage + (3 + 1)
                                "
                                >...</a
                            >
                        </li>

                        <li
                            class="page-item"
                            :class="{ disabled: currentPage === totalPage }"
                            @click="nextPage(merchants.meta['next_page_url'])"
                        >
                            <a class="page-link">Next</a>
                        </li>
                    </ul>
                </nav>
</template>

<script>
  data(){
    return {
      pageNumber: 0,
            merchants: [],
            currentPage: 1,
            totalPage: 0,
            nextPageUrl: null,
            perPage: 0,
            search: "",
    }
  },
         setCurrentPage(page) {
            this.currentPage = page;
            this.fetchMerchants(page, "", this.search);
        },
        nextPage(url) {
            if (this.currentPage < this.totalPage) {
                axios.get(url + this.search).then((response) => {
                    console.log("response", response.data);
                    this.merchants = response.data;
                    this.currentPage = response.data.meta["current_page"];
                });
            }
        },
        prevPage(url) {
            if (this.currentPage !== 1) {
                axios.get(url).then((response) => {
                    this.merchants = response.data;
                    this.currentPage = response.data.meta["current_page"];
                });
            }
        },
</script>

                
