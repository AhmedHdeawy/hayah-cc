<div>
	<canvas id="newPropertiesChart"></canvas>
</div>

@push('js')
<script>
	$(document).ready(function() {

		{{-- Data for Chart --}}
		var lineChartData = {
			labels: [
				@foreach($newProperties as $key => $value)
					"{{ $key }}",
				@endforeach
			],
			datasets: [
				{
					label: '{{ __('dashboard.newProperty') }}',
					fillColor: "rgb(99, 194, 222)",
                	strokeColor: "rgb(99, 194, 222)",
					lineTension: 0,
					pointBorderColor: chartColors.stopped,
				    pointBackgroundColor: 'rgb(99, 194, 222)',
				    pointRadius: 5,
				    pointHoverRadius: 10,
				    pointHitRadius: 30,
				    pointBorderWidth: 1,
				    pointStyle: 'rectRounded',
					data: [
						@foreach($newProperties as $key => $value)
							{{ $value }},
						@endforeach
					],
				}
			]

		};

		// Start Intitlize Chart
		var propertiesCtx = document.getElementById('newPropertiesChart').getContext('2d');
		propertiesCtx.canvas.width = 1000;
		propertiesCtx.canvas.height = 300;
		var propertiesChart = new Chart(propertiesCtx, {
		    // The type of chart we want to create
		    type: 'line',
		    data: lineChartData,

		    options: {
		    	legend: {
		    		display: true,
		    		position: 'top',
		    		rtl: '{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'true' : '' }}',
		            labels: {
		            	boxWidth: 80,
		                // fontSize: '10',
		                fontStyle: 'bold',
		                fontFamily: 'Tajawal',
		            }
		        },
				responsive: true,
			}
		});
	});
</script>

@endpush
