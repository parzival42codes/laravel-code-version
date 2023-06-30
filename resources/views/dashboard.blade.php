<style>
    table {
        border: 1px black solid;
    }

    table td {
        border: 1px black dashed;
        padding: 5px;
    }

    table td.versionCompare {
        background: black;
    }

    tr:nth-child(even) {background: #CCC}
    tr:nth-child(odd) {background: #FFF}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <table style="width: 100%;">

                        <tr>
                            <th>Class</th>
                            <th>&nbsp;</th>
                            <th>Version</th>
                            <th>Version Compare</th>
                            <th>Note</th>
                        </tr>

                        @foreach($codeData as $code)

                            @if($code['versionDoc'])

                                @foreach($code['version'] as $codeKey => $codeVersion )

                                    @if($codeVersion)

                                        <tr>
                                            <td>{{ $code['discover'] }}</td>
                                            <td>{{ $codeKey }}</td>
                                            <td>{{ $codeVersion }}</td>
                                            <td class="versionCompare">
                                                @if($code['versionCompare'][$codeKey] === -1)
                                                    <span style="color:yellow;">Lower</span>
                                                @elseif($code['versionCompare'][$codeKey] === 0)
                                                    <span style="color:green;">Equal</span>
                                                @elseif($code['versionCompare'][$codeKey] === 1)
                                                    <span style="color:red;">Higher</span>
                                                @endif

                                            </td>
                                            <td>{{ $code['note'][$codeKey] ?? '' }}</td>
                                        </tr>

                                    @endif

                                @endforeach

                            @else

                                <tr>
                                    <td>{{ $code['discover'] }}</td>
                                    <td>{{ $codeKey }}</td>
                                    <td>&nbsp;</td>
                                    <td><span style="color:black;">No Data</span></td>
                                    <td>&nbsp;</td>
                                </tr>

                            @endif
                        @endforeach

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
