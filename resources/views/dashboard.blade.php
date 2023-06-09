@include('code-version::header')

<div id="tableContainer">

<table>

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
                                <span style="color:lime;">Equal</span>
                            @elseif($code['versionCompare'][$codeKey] === 1)
                                <span style="color:red;">Higher</span>
                            @endif

                        </td>
                        <td>{{ $code['note'][$codeKey] ?? '' }}</td>
                    </tr>

                @else

                    <tr>
                        <td>{{ $code['discover'] }}</td>
                        <td>{{ $codeKey }}</td>
                        <td>&nbsp;</td>
                        <td class="versionCompare"><span style="color:white;">No Data</span></td>
                        <td>&nbsp;</td>
                    </tr>

                @endif

            @endforeach

        @else

            <tr>
                <td>{{ $code['discover'] }}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="versionCompare"><span style="color:white;">Class has no Data</span></td>
                <td>&nbsp;</td>
            </tr>

        @endif
    @endforeach

</table>

</div>

@include('code-version::footer')
