@props(['campaign'])

<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Campaigns') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white ">
                    <div class="w-full flex items-start justify-between">
                        <div class="grow-1 text-2xl font-semibold">{{ $campaign->name }}</div>
                        <div>

                            <Link modal href="{{ '/qr-code/create/' . $campaign->id }}"
                                class="flex items-center justify-between space-x-2 bg-green-500 text-sm rounded-md shadow-md cursor-pointer text-white font-bold px-4 py-2"
                                href="{{ route('mycampaigns') }}">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                    stroke-width="2" class="h-6 w-6" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>

                            </div>
                            <div>Add a Link / QR Code</div>
                            </Link>
                            <div class="mt-4 flex justify-end items-center">
                                <div
                                    class="w-6 h-6 flex items-center justify-center mr-2 bg-yellow-500 rounded-md px-1 py-0.5 cursor-pointer text-white font-semibold uppercase text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                        stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5m-1.414-9.414a2 2 0 1 1 2.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>

                                <Link confirm href="/"
                                    class="w-6 h-6 flex items-center justify-center  bg-red-500 rounded-md px-1 py-0.5 cursor-pointer text-white font-semibold uppercase text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                    stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19 7-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16" />
                                </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                    @if (count($qrcodes) === 0)
                        <div class="mt-8 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                            <p class="font-bold">Welcome to {{ env('APP_NAME') }}</p>
                            <p>Try adding your first Trackable QR Code or Trackable Link</p>
                        </div>
                    @else
                        <div class="mt-8">
                            <h3 class="mb-4 text-xl font-semibold">QR Codes</h3>
                            <div class="grid grid-cols-1 gap-4">
                                @foreach ($qrcodes as $qrcode)
                                    <div
                                        class="mx-auto w-full bg-gray-200 flex items-center justify-start space-x-2 border-b border-gray-500 cursor-pointer text-black font-bold px-4 py-2">
                                        <div>
                                            @if (Storage::disk('public')->exists($campaign->id . '-' . $qrcode->id . '.png'))
                                                <img class="w-20 h-20" src="{{ asset('storage/' .$campaign->id . '-' . $qrcode->id . '.png') }}"
                                                    alt="Your Image Alt Text">
                                            @else
                                                <p>Image not found</p>
                                            @endif
                                        </div>
                                        <div class='flex justify-between'>
                                        <div class="flex items-center">
                                            <div>
                                                <p>{{ $qrcode->name }}</p>
                                                <p class='text-base mt-4 font-light'>{{ $qrcode->description }}</p>
                                            </div>
                                        </div>
                                        <div class='flex space-x-2'>
                                            <Link confirm href="/qrcodes/{{ $qrcode->id }}/edit"
                                                class="w-6 h-6 flex items-center justify-center bg-yellow-500 rounded-md px-1 py-0.5 cursor-pointer text-white font-semibold uppercase text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                                stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5m-1.414-9.414a2 2 0 1 1 2.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            </Link>
                                            <Link confirm href="/qrcodes/{{ $qrcode->id }}/delete"
                                                class="w-6 h-6 flex items-center justify-center bg-red-500 rounded-md px-1 py-0.5 cursor-pointer text-white font-semibold uppercase text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            </Link>
                                        </div>
                                        </div>
                                    </div>
                                @endforeach

                    @endif
                    <section class="mt-8">
                        <h3 class="mb-4 text-xl font-semibold">About this Campaign</h3>
                        {{ $campaign->description }}
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>
