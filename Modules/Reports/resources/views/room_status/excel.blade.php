<table class="table table-bordered table-hover table-sm" id="datatable">
    <thead class="thead-default thead-lg">
    <tr>
        <th colspan="9" class="text-center">{{$header}}</th>
    </tr>
    <tr>
        <th>S/N</th>
        <th>Room #</th>
        <th>Room Type</th>
        <th>Rate</th>
        <th>Guest</th>
        <th>Arrival</th>
        <th>Expected Departure</th>
        <th>No of Nights</th>
        <th>Pax</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$item->room_number}}</td>
            <td>{{$item->room_type}}</td>
            <td style="text-align: right">{{number_format($item->rate)}}</td>
            <td>{{$item->guest}}</td>
            <td>{{$item->arrival_date ? date('d M Y',strtotime($item->arrival_date)):""}}</td>
            <td>{{$item->arrival_date ? date('d M Y',strtotime($item->departure_date)):""}}</td>
            <td style="text-align: right">{{number_format($item->no_of_nights)}}</td>
            <td style="text-align: right">{{number_format($item->pax)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
