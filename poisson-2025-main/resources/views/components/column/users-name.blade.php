<div>
    {{ $row->name }}
    @if(($row->university_tipe <= 2 && $row->university_type >= 0) && $row->college && $row->no_telp && $row->student_card && $row->school_logo && $row->year_in && $row->link_twibbon)
    <x-badges.success name="Lengkap" />
    @endif
</div>
