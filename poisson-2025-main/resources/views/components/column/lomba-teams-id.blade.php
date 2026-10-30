<a class="underline" href=" {{ route('teams_details', ['id' => $row->id]) }}">
    @if ($row->type == 'olimpiade')
        <p>{{ "SO{$row->id}" }}</p>
    @elseif ($row->type == 'osc')
        <p>{{ "OSC{$row->id}" }}</p>
    @else
        <p>{{ "SI{$row->id}" }}</p>
    @endif
</a>
