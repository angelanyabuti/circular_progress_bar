<div>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel4">Coupon Validation</h4>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Code</label>
                            <input wire:model="code" class="form-control" name="code">
                            @error('code') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="mt-3">
                <button wire:click.prevent="vak()"
                        class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Validate
                </button>
            </div>
        </div>
    </div>
</div>
