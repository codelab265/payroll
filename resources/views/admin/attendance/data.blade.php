<div class="table-responsive tableFixHead">
    <table class="table table-nowrap mb-0">
        <thead>
            <tr>
                <th>Name</th>
                @for ($i = 1; $i <= $daysInMonth; $i++)
                    <th>{{ $i }}</th>
                @endfor
                <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($employees as $user)
                @php
                    $totalPresent = 0;
                @endphp
                <tr>
                    <td>{{ $user->name }}</td>
                    @for ($i = 1; $i <= $daysInMonth; $i++)
                        @php
                            $d = $i < 10 ? '0' . $i : $i;
                            $m = $current_month;
                            $y = $current_year;
                            $date = $y . '-' . $m . '-' . $d;
                        @endphp
                        <td>
                            @if ($user->attendance->where('attendance_date', $date)->count() > 0)
                                <box-icon name='check' size="sm" color="green"></box-icon>

                                @php
                                    $totalPresent++;
                                @endphp
                            @else
                                <box-icon name='x' size="sm" color="red"></box-icon>
                            @endif

                        </td>
                    @endfor
                    <td>
                        {{ $totalPresent }}/{{ $daysInMonth }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
