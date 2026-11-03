<x-table :theads="['nomor peserta','nama', 'email', 'whatsapp','universitas/sekolah']">
    @foreach ($users as $item)
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">POI_{{ $item->id }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p class="font-semibold">{{ $item->name }}</p>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>{{ $item->email }}</p>
            </td>
            <td class="px-4 py-3 text-sm whitespace-nowrap">
                <p>{{ $item->no_telp }}</p>
            </td>
            <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
                <p>{{ $item->college }}</p>
            </td>
        </tr>
    @endforeach
</x-table>
