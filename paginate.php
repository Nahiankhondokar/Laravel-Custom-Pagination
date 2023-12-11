// Custom Pagination By Laravel

  $perPage = 10; // item limit
    $currentPage = $request->query('page', 1); // page come form request

    $collection = collect($newArr)->sortByDesc('attribute name'); // sort by desc
    $currentPageItems = $collection->forPage($currentPage, $perPage)->values()->all(); // page wise items

    $paginator = new LengthAwarePaginator(
        $currentPageItems,
        $collection->count(),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    ); // Laravel paginator class use for pagination

    $paginationData = [
        'current_page' => $paginator->currentPage(),
        'per_page' => $paginator->perPage(),
        'total' => ceil($paginator->total() / $perPage),
        'next_page_url' => $paginator->nextPageUrl(),
        'prev_page_url' => $paginator->previousPageUrl(),
    ];
