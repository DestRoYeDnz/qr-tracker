<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Campaigns') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full flex items-center justify-between">
                        <div
                        class="text-2xl font-semibold">My Campaigns
                        </div>
                        <div>
                            <div class="flex items-center justify-between space-x-2 bg-green-500 text-sm rounded-md shadow-md cursor-pointer text-white font-bold px-4 py-2" href="{{ route('mycampaigns') }}">
                                </Link>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" class="h-6 w-6" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>

                                </div>
                                <div >Create Campaign</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>