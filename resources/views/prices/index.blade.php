@extends('layouts.app')

@section('content')

    @if($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
            <strong class="font-bold">Something went wrong!</strong>
        </div>
    @endif

    <section class="max-w-2xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">OpenPlay</h2>

        <form action="{{ route('price-calculator') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="product">Product</label>
                    <select id="product" name="product"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" @if((int)session()->get('product') === $product->id) selected @endif> {{ $product->id }} - {{ $product->name }}</option>
                        @endforeach
                    </select>
                    <div class="-m-2 text-center">
                        <div class="p-2">
                            @error('product')
                            <div class="flex items-center bg-white leading-none text-pink-600 p-2 text-teal text-sm">
                                    <span class="inline-flex px-2">
                                        {{ $message }}
                                    </span>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="member">Member</label>
                    <select id="member" name="member"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">

                        @foreach($members as $member)
                            <option value="{{ $member->id }}" @if((int)session()->get('member') === $member->id) selected @endif>{{ $member->id }} - {{ $member->name }} - {{ $member->membership_type }}</option>
                        @endforeach
                    </select>
                    <div class="-m-2 text-center">
                        <div class="p-2">
                            @error('member')
                            <div class="flex items-center bg-white leading-none text-pink-600 p-2 text-teal text-sm">
                                    <span class="inline-flex px-2">
                                        {{ $message }}
                                    </span>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="venue">Venue</label>
                    <select id="venue" name="venue"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">

                        @foreach($venues as $venue)
                            <option value="{{ $venue->id }}" @if((int)session()->get('venue') === $venue->id) selected @endif>{{ $venue->id }} - {{ $venue->name }}</option>
                        @endforeach
                    </select>
                    <div class="-m-2 text-center">
                        <div class="p-2">
                            @error('venue')
                                <div class="flex items-center bg-white leading-none text-pink-600 p-2 text-teal text-sm">
                                    <span class="inline-flex px-2">
                                        {{ $message }}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex mt-6">
                <button
                    class="w-full px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                    Calculate
                </button>
            </div>
        </form>
        @if(session()->has('lowerPrice'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold mt-5 px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>Your lowest applicable price is: £{{ session()->get('lowerPrice') }}</p>
            </div>
            <p></p>
        @endif
    </section>
@endsection
