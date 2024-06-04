@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @php
                    $collection = collect([1, 2, 3, 4, 5]);
                    $result = $collection->map(function ($item) {
                        return $item * 2;
                    });
                    echo $result."<br>";
                @endphp

                @php
                    $dummyData = collect([
                        ['name' => 'Alice', 'age' => 25],
                        ['name' => 'Bob', 'age' => 30],
                        ['name' => 'Charlie', 'age' => 35],
                        ['name' => 'David', 'age' => 40],
                        ['name' => 'Eve', 'age' => 45],
                    ]);
                    $filter=$dummyData->filter(function($item){
                        return $item['age'] > 30;
                    });

                    foreach ($filter as $item) {
                        echo $item['name']."<br>";
                    }
                @endphp
            </div>
        </div>
    </div>
@endsection
