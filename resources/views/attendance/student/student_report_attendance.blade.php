<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/ico" href="{{asset('assets')}}/dist/img/owl-logo.svg">
    <title>Clubspectre | Student's Report Attendance</title>

    <style>
        body {
            line-height: 1.6;
            margin: 1.5em;
            min-width: 990px;
        }

        th {
            background-color: #001f3f;
            color: #fff;
            padding: 0.2em .5em;
        }

        td {
            border-top: 1px solid #eee;
            padding: 0.2em .5em;
        }

        input {
            cursor: pointer;
        }

        /* Column types */
        th.missed-col {
            background-color: #f00;
        }
        td.missed-col {
            background-color: #ffecec;
            color: #f00;
            text-align: center;
        }
        th.present-col {
            background-color: rgb(30, 255, 0);
        }
        td.present-col {
            background-color: #f0ffec;
            color: rgb(30, 255, 0);
            text-align: center;
        }
        th.late-col {
            background-color: rgb(255, 196, 0);
        }
        td.late-col {
            background-color: #fff9ec;
            color: rgb(255, 196, 0);
            text-align: center;
        }
        .name-col {
            text-align: left;
        }
        
    </style>
</head>
<body>
    <h1>Student Attendance</h1>
    <table>
        <tbody>
            <tr>
                <td>
                    Name: {{ $report['student']->user->name }} <br>
                </td>
            </tr>
            <tr>
                <td>
                    Email: {{ $report['student']->user->email }} <br>
                </td>
            </tr>
            <tr>
                <td>
                    Gender: {{ $report['student']->gender }} <br>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <tbody>
            <tr>
                <td>
                    Total Days In this Month: {{ $report['daysInAMonth'] }} <br>
                </td>
            </tr>
            <tr>
                <td>
                    Working Days: {{ $report['workingDays'] }} <br>
                </td>
            </tr>
            <tr>
                <td>
                    Weekends: {{ $report['weekends'] }} <br>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <th class="name-col">Teacher Name</th>
                @for($i=1;$i <= $report['workingDays'];$i++)
                    <th>{{$i}}</th>
                @endfor
                <th class="present-col">Present</th>
                <th class="late-col">Late</th>
                <th class="missed-col">Absent</th>
            </tr>
        </thead>
        <tbody>
            <tr class="student">
                <td class="name-col">{{$report['student']->user->name}}</td>
                @php
                    $dateAttendance = $report['getAttendance']->pluck('date')->toArray();
                    $allDateOfAttended = $report['getAttendance']->all('date', 'status');
                @endphp
                @for($i=0;$i < $report['daysInAMonth'];$i++)
                    @php
                        $dayName = now()->setYear($report['year'])->setMonth($report['month'])->setDay($i)->format('l');
                    @endphp
                    @if (($dayName != "Friday") && ($dayName != "Saturday"))
                        @php
                            $date = \Carbon\Carbon::create($report['year'], $report['month'], $i+1)->format('Y-m-d');
                            $checked = (in_array($date,$dateAttendance)) ? "checked" : "";
                        @endphp
                        <td class="attend-col"><input type="checkbox" {{$checked}} disabled></td>
                    @endif
                @endfor
                <td class="present-col">{{$report['getAttendance']->where('status', "P")->count()}}</td>
                <td class="late-col">{{$report['getAttendance']->where('status', "L")->count()}}</td>
                <td class="missed-col">{{$report['getAttendance']->where('status', "A")->count()}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table>
        <tbody>
            <tr>
                <td>
                    Total Attendance: {{ $report['getAttendance']->count() }}
                </td>
            </tr>
        </tbody>
    </table>
    <h4>Absent Days</h4> <br>
    <table>
        <tbody>
            @foreach ($allDateOfAttended as $date)
                @if($date->status == 'A')    
                <tr>
                    <td>
                        {{$date->date}}
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    
</body>
</html>