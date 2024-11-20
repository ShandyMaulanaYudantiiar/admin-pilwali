<x-filament::widget>
    <x-filament::card>
        <table class="divide-y divide-gray-200 w-full">
    <thead>
    <tr>
        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Kecamatan
        </th>
        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Total Relawan
        </th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @foreach ($relawanByKecamatan as $item)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->kecamatan }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $item->total }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
    </x-filament::card>
</x-filament::widget>
