<div class="filament-widget">
    <h2 class="text-xl font-bold">Top 5 Recommanders with Most Relawans</h2>
    <table class="table-auto w-full mt-4">
        <thead>
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Nama Recommander</th>
            <th class="px-4 py-2">Relawan Count</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($recommanders as $recommander)
            <tr>
                <td class="border px-4 py-2">{{ $recommander->id }}</td>
                <td class="border px-4 py-2">{{ $recommander->nama_recommander }}</td>
                <td class="border px-4 py-2">{{ $recommander->relawan_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
