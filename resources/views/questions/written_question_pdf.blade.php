<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ env('APP_NAME') }} | Wriiten Examination Questions</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
            .success-text{
                color: green;
            }
            .danger-text{
                color: red;
            }
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="{{asset('assets')}}/dist/img/main-logo.svg" height="40" width="40" /> Clubspectre
								</td>

								<td>
									Created Date: {{ $exam->created_at->format('d/m/Y') }}<br />
                                    Time: {{ $exam->created_at->format('h:i a') }}
								</td>
							</tr>
						</table>
					</td>
				</tr>
                <tr>
                    <td style="text-align: center; font-weight: bold; font-size: 32px;">{{$exam->name}}</td>
                </tr>
                <tr>
                    <td style="text-align: center; font-size: 18px;">{{$exam->classroom->name}}</td>
                </tr>
                <tr>
                    <td style="text-align: center; font-size: 16px;">{{$exam->classroom->course->name}} ({{$exam->classroom->course->code}})</td>
                </tr>
				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									Time: {{$exam->duration}} Minutes
								</td>

								<td>
									Marks: {{$exam->marks}}
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
			</table>
			<div>
				<h3><b> </b></h3>
			</div>
            <div>
                @if($exam->type == 1)
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($questions as $question)
                        <h5> <span style="font-size: 18px;">{{ $count }}.</span> {!! $question->question !!}</h5>{{$question->mark}}
                        @php
                            $count++;
                        @endphp
                    @endforeach
                @endif
            </div>
		</div>
	</body>
</html>