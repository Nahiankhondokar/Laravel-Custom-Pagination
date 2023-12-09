        $perPage = 10; 
        $currentPage = $request->query('page', 1);

        $collection = collect($newArr)->sortByDesc('order_count');
        $currentPageItems = $collection->forPage($currentPage, $perPage)->values()->all();

        $paginator = new LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $paginationData = [
            'current_page' => $paginator->currentPage(),
            'per_page' => $paginator->perPage(),
            'total' => ceil($paginator->total() / $perPage),
            'next_page_url' => $paginator->nextPageUrl(),
            'prev_page_url' => $paginator->previousPageUrl(),
        ];
