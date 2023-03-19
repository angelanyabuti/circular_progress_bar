<div class="col-12 col-md-4 d-flex">
    <div class="card border-green">
        <img class="card-img-top" height="230" style="object-fit: fill" src="{{ $item -> default_image }}" alt="">
        <div class="card-body flex-fill">
            <div class="d-flex justify-content-between">
                <a class="text-sahl" href="#"><span class="font-weight-bold text-uppercase">{{ $item -> name }}</span></a>

                <input type="hidden" name="package" value="{{ $item -> id }}">
                <a class="text-sahl" href="#"   role="button">
                    <i class="dripicons-heart noti-icon text-sahl font-20 ml-2"></i>
                </a>
            </div>
            <p>
                <strong class="text-success">EUR {{ (int) $item -> price }}</strong>
                <a href="#" class="btn btn-outline-warning btn-sahl btn-sm float-right">
                    View
                    <i class="dripicons-arrow-thin-right"></i>
                </a>
            </p>

        </div>
    </div>
</div>
