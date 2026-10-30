@if ($row->type == 'olimpiade')
    <p>{{ "SO{$row->id}" }}</p>
@elseif ($row->type == 'osc')
    <p>{{ "OSC{$row->id}" }}</p>
@else
    <p>{{ "SI{$row->id}" }}</p>
@endif
