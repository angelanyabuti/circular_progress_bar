<div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <section class="mb-5 mt-5 pb-5">
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    Plan {{ $plan -> name }}
                                </div>
                                <div class="card-body">
                                    <form action="https://payments.ipayafrica.com/v3/ke">
                                        @if($nvoice)
                                        @foreach($fs  as $key => $value)
                                            <input type="hidden" value="{{ $value }}" name="{{ $key }}">
                                        @endforeach
                                        <input type="hidden" name="hsh" value="{{ $hash }}">
                                        @endif

                                        @if(!$invoice->paid)
                                            <button type="submit" class="btn btn-warning mt-5">Pay</button>
                                        @else
                                            <p>Subscription fee has already been paid</p>
                                            <a href="#" wire:click.prevent="startSub()" class="btn btn-success btn-sm">Go to your dashboard</a>
                                        @endif

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
