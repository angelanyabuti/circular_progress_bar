<?php

namespace App\Http\Livewire\Merchant;

use App\Models\ShippingBatch;
use App\Models\ShopSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShippingBatchedComponent extends Component
{
    public $status, $activeId;
    public function render()
    {
        return view('livewire.merchant.shipping-batched-component',[
            'items'=> ShippingBatch::where('shop_id', Auth::user()->shop_id)->orderBy('id','desc')->get()
        ]);
    }

    public function setActive($id)
    {
        $this->activeId = $id;
    }

    public function changeStatus()
    {
        $this->validate([
            'status'=>'required',
            'active_id'=>'required'
        ]);

        DB::table('shipping_batches')->where('id', $this->activeId)->update(['status'=>$this->status]);
        $this->emit('updated');
    }
}
