@extends('manager.layouts.app')

@section('page-title', 'View Analytics')
@section('page-description', 'Analyze harvest productivity, task performance and pest incident trends.')

@section('content')

{{-- Summary Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold text-green-800 mb-4">
            Harvest Analytics
        </h2>

        <p class="text-gray-600 mb-2">
            Total Harvest Records
        </p>

        <h3 class="text-4xl font-bold text-green-700">
            {{ $harvests->count() }}
        </h3>

        <p class="text-gray-600 mt-5 mb-2">
            Total Yield
        </p>

        <h3 class="text-4xl font-bold text-blue-600">
            {{ number_format($harvests->sum('yield_kg'),2) }} KG
        </h3>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold text-green-800 mb-4">
            Pest Analytics
        </h2>

        <p class="text-gray-600 mb-2">
            Total Pest Reports
        </p>

        <h3 class="text-4xl font-bold text-red-600">
            {{ $pestReports->count() }}
        </h3>

        <p class="text-gray-600 mt-5 mb-2">
            High Severity Reports
        </p>

        <h3 class="text-4xl font-bold text-red-700">
            {{ $pestReports->where('severity','High')->count() }}
        </h3>

    </div>

</div>

{{-- Charts --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-bold text-green-800 mb-4">
            Task Status
        </h2>

        <canvas id="taskChart"></canvas>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-bold text-green-800 mb-4">
            Pest Severity Distribution
        </h2>

        <canvas id="severityChart"></canvas>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-bold text-green-800 mb-4">
            Most Reported Pest
        </h2>

        <canvas id="pestChart"></canvas>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-bold text-green-800 mb-4">
            Harvest by Grade
        </h2>

        <canvas id="harvestChart"></canvas>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('taskChart'),{

    type:'bar',

    data:{
        labels:@json($taskStatus->keys()),
        datasets:[{
            label:'Number of Tasks',
            data:@json($taskStatus->values()),
            backgroundColor:[
                '#16a34a',
                '#facc15',
                '#2563eb'
            ]
        }]
    },

    options:{
        responsive:true,
        plugins:{
            legend:{
                display:false
            }
        }
    }

});

new Chart(document.getElementById('severityChart'),{

    type:'pie',

    data:{
        labels:@json($pestSeverity->keys()),
        datasets:[{
            data:@json($pestSeverity->values()),
            backgroundColor:[
                '#16a34a',
                '#facc15',
                '#dc2626'
            ]
        }]
    }

});

new Chart(document.getElementById('pestChart'),{

    type:'bar',

    data:{
        labels:@json($pestTypes->keys()),
        datasets:[{
            label:'Reports',
            data:@json($pestTypes->values()),
            backgroundColor:'#16a34a'
        }]
    },

    options:{
        responsive:true,
        plugins:{
            legend:{
                display:false
            }
        }
    }

});

new Chart(document.getElementById('harvestChart'),{

    type:'doughnut',

    data:{
        labels:@json($harvestByGrade->keys()),
        datasets:[{
            data:@json($harvestByGrade->values()),
            backgroundColor:[
                '#16a34a',
                '#2563eb',
                '#facc15'
            ]
        }]
    }

});

</script>

@endsection