<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaction &raquo; # {{ $transaction->id }} {{ $transaction->name }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            var dataTable = $('#crudTable').DataTable({
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: '5%'
                    },
                    {
                        data: 'product.name',
                        name: 'product.name'
                    },
                    {
                        data: 'product.price',
                        name: 'product.price'
                    },
                ]
            })
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-6">
                Transaction Details
            </h2>

            <div class="bg-white overflow-hidden shadow sm:rounded-lg mb-10">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <tbody>
                            <tr>
                                <th class="border px-6 py-4 text-right">Name</th>
                                <td class="border px-6 py-4">{{ $transaction->name }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Email</th>
                                <td class="border px-6 py-4">{{ $transaction->email }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Address</th>
                                <td class="border px-6 py-4">{{ $transaction->address }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Phone</th>
                                <td class="border px-6 py-4">{{ $transaction->phone }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Desc</th>
                                <td class="border px-6 py-4">{{ $transaction->desc }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Image</th>
                                <td class="border px-6 py-4">
                                    {{-- <p>{{ Storage::url($transaction->url) }}</p>
                                    <p>{{ url('public/storage/' . $transaction->url) }}</p> --}}
                                    @php
                                        // $str = $transaction->url . split('/')[2];
                                        $str = explode('/', $transaction->url);
                                    @endphp
                                    <img src="{{ asset('storage/' . $str[1] . '/' . $str[2]) }}" style="width: 200px"
                                        alt="">
                                </td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Total Price</th>
                                <td class="border px-6 py-4">{{ number_format($transaction->total_price) }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Status</th>
                                <td class="border px-6 py-4">{{ $transaction->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-6">
                Transaction Items
            </h2>
            <div class="shadow overflow-hidden sm-rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produk</th>
                                <th>Total Harga</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
