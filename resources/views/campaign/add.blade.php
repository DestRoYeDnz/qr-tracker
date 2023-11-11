<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Campaign') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full flex items-center justify-between">
                    </div>
                    <x-splade-form action="{{ route('mycampaigns.store') }}" :default="['user_id' => auth()->id()]">
                        <x-splade-input :show-errors="true" class="mt-8" name="campaign_name" label="Campaign Name"
                            type="text" />
                        <x-splade-textarea class="mt-8 h-32" name="description" label="Campaign Description" />
                        <x-splade-submit class='mt-8'>
                            {{ __('Create Campaign') }}
                        </x-splade-submit>
                    </x-splade-form>
 <input type="color" list="presetColors">
  <datalist id="presetColors">
    <option>#ff0000</option>
    <option>#00ff00</option>
    <option>#0000ff</option>
  </datalist>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
