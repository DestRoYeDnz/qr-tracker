@props(['users'])

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
                        <div class="text-2xl font-semibold">My Campaigns</div>
                        <div>
                            <Link href="my-campaign/add"
                                class="flex items-center justify-between space-x-2 bg-green-500 text-sm rounded-md shadow-md cursor-pointer text-white font-bold px-4 py-2"
                                href="{{ route('mycampaigns') }}">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                    stroke-width="2" class="h-6 w-6" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>

                            </div>
                            <div>Create Campaign</div>
                            </Link>

                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <x-splade-table :for="$users">
                        <x-splade-cell status>
                            <div class="bg-blue-500 rounded-md px-2 py-1 text-white font-semibold uppercase text-sm">
                                {{ $item->status }}</div>
                        </x-splade-cell>
                        <x-splade-cell name>
                            <div class="font-semibold text-sm">
                                <Link href={{ url('/my-campaign/'.$item->id) }}>{{ $item->name }}</Link>
                                </div>
                        </x-splade-cell>
                        <x-splade-cell class="" actions>
                            <div
                                class="mr-2 bg-yellow-500 rounded-md px-1 py-0.5 cursor-pointer text-white font-semibold uppercase text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                    stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5m-1.414-9.414a2 2 0 1 1 2.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>

                            <div
                                class="bg-red-500 rounded-md px-1 py-0.5 cursor-pointer text-white font-semibold uppercase text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                    stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19 7-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16" />
                                </svg>
                            </div>
                        </x-splade-cell>
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
