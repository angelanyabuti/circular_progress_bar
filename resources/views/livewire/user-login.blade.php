<div>
    <form class="px-4 py-3">
        <div class="form-group">
            <label>Email address</label>
            <input wire:model.lazy="email" type="email" class="form-control" placeholder="email@example.com">
            @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input wire:model.lazy="password" type="password" class="form-control" placeholder="Password">
            @error('password') <span class="text-danger error">{{ $message }}</span>@enderror

        </div>
        <button wire:click.prevent="login()" type="submit" class="btn btn-primary">Sign in</button>
    </form>
    <hr class="dropdown-divider">
    <a class="dropdown-item text-success" href="#">Have account? Sign up</a>
    <a class="dropdown-item text-success" href="#">Forgot password?</a>
</div>
