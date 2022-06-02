<thead>
<tr>
    @foreach($menu as $row)
        @if(isset($row['index']) && $row['index'] == true)
            <th>{{$row['label']}}</th>
        @endif
    @endforeach
    <th class="text-right">Actions</th>
</tr>
</thead>
