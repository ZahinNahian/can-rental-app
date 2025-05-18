<h2>{{ $heading }}</h2>

<p><strong>Hello, </strong> {{ $user->name }}</p>
<p>Here is the detail of the rental-</p>
<p><strong>Car:</strong> {{ $car->name }} - {{ $car->model }} ({{ $car->year }})</p>
<p><strong>Car Type:</strong> {{ $car->car_type }}</p>
<p><strong>Total Cost:</strong> ${{ $rental->total_cost }}</p>
<p><strong>Rental Period:</strong> {{ $rental->start_date }} to {{ $rental->end_date }}</p>
<p><strong>Total Days:</strong> {{ $days }}</p>
