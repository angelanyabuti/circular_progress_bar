<div>
    <div class="shop-pagination pb-3">
        <div class="container">
            <div class="card">
                <div class="card-body p-2">
                    <div class="d-flex align-items-center justify-content-between">
{{--                        <small class="ms-1">Showing 6 of 31</small>--}}
                        <form>
                            <input type="text" class="form-control" placeholder="search ...">
                        </form>
                        <form action="#">

                            <select class="pe-4 form-select form-select-sm form-control-clicked" id="defaultSelectSm" name="defaultSelectSm" aria-label="Default select example">
                                <option value="1" selected="">Sort by Newest</option>
                                <option value="2">Sort by Older</option>
                                <option value="3">Sort by Ratings</option>
                                <option value="4">Sort by Sales</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('shop.partial.prod')


</div>
