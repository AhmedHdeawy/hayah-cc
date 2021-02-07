<div class="">
	<canvas id="propertiesStatus"></canvas>
</div>

@push('js')
<script>
	$(document).ready(function() {

		var ctx = document.getElementById('propertiesStatus').getContext('2d');
			var chart = new Chart(ctx, {
			    // The type of chart we want to create
			    type: 'pie',

			    // The data for our dataset
			    data: {
			        labels: [
			        	'{{ __('dashboard.activeProperties') }}',
			        	'{{ __('dashboard.stoppedProperties') }}',
			        ],
			        datasets: [{
			            label: 'My First dataset',
			            backgroundColor: [
			            	chartColors.active,
			            	chartColors.stopped,
			            ],
			            // borderColor: 'rgb(255, 99, 132)',
			            data: [
			            	'{{ $propertiesStatus['active'] }}',
			            	'{{ $propertiesStatus['stopped'] }}',
			            ]
			        }]
			    },

			    // Configuration options go here
			    options: {
			    	legend: {
			    		rtl: '{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'true' : '' }}',
			            labels: {
			                // fontSize: '10',
			                fontStyle: 'bold',
			                fontFamily: 'Tajawal',
			            }
			        },
			    	responsive: true
			    }
			});
	});
</script>

@endpush
