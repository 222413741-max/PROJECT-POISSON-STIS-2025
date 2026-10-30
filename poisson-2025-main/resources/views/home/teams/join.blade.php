<form wire:submit.prevent="assignteam">
    <div>
        <label for="token" class="text-sm text-gray-600 dark:text-gray-300">Token</label>
        <x-input id="token" type="text" class="mt-1 block w-full" wire:model.defer="token" />
    </div>

    <small class="text-gray-500 block my-1 dark:text-gray-400">{{ __('dashboard.input-token') }}</small>

    <x-button class="float-right">
        {{ __('dashboard.gabung-tim') }}
    </x-button>
</form>
