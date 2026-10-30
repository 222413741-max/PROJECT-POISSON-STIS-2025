<x-table :theads="['nomor team', 'nama team', 'aksi']">
    <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
            <p class="font-semibold">OSC_{{ $team->id }}</p>
        </td>
        <td class="px-4 py-3 text-sm lg:whitespace-nowrap">
            {{-- <p class="font-semibold">{{ $team->name }}</p> --}}
        </td>
        <td class="px-4 py-3 text-sm whitespace-nowrap">
            {{-- <p>{{ $item->email }}</p> --}}
        </td>
    </tr>
</x-table>
tes
