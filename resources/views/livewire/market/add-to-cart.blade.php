<div>
    <p>
        {{ $product['type'] }}
    </p>
    <p>
        {{ $product['name'] }}
    </p>
    @if($product['type'] == 'product')
        <a href="#" wire:click.prevent="add()" class="btn btn-dark btn-block mt-2">Add to Cart</a>
    @else
        <a href="#" wire:click.prevent="add()" class="btn btn-dark btn-block mt-2">Redeem Now!</a>

    @endif

</div>
