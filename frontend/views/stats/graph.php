<?php
/* @var $this yii\web\View */
//
 use yii\web\JsExpression;
?>


    <h3>Second</h3>
    <div class="card card-body" style="height: 50%;width: 50%">
        <div class="card-body">
            <?php
            use dosamigos\chartjs\ChartJs;
            echo ChartJs::widget([
                'type' => 'radar',
                'options' => [
                    'height' => 400,
                    'width' => 400,
                ],
                'data' => [
                    'labels' => ["Підтримка", "Зручність використання", "Ефективність", "Універсальність", "Коректність"], 
                    'datasets' => [
                        [
                            'data' =>['0.71', '0.86', '0.81', '0.61', '0.77'], 
                            'label' => 'byTrack',
                            'backgroundColor' => [
                                'rgba(190, 124, 145, 0.0)'
                            ],
                            'borderColor' =>  [
                                '#0061ff',
                                '#0061ff',
                                '#0061ff',
                                '#0061ff',
                                '#0061ff'
                            ],
                            'borderWidth' => 1,
                            'hoverBorderColor'=>["#0061ff","#0061ff","#0061ff","#0061ff","#0061ff"],
                        ],
                        [
                            'data' =>['0.56', '0.49', '0.75', '0.51', '0.65'], 
                            'label' => 'Bugzilla',
                            'backgroundColor' => [
                                'rgba(190, 124, 145, 0.0)'
                            ],
                            'borderColor' =>  [
                                '#20cc5f',
                                '#20cc5f',
                                '#20cc5f',
                                '#20cc5f',
                                '#20cc5f'
                            ],
                            'borderWidth' => 1,
                            'hoverBorderColor'=>["#20cc5f","#20cc5f","#20cc5f","#20cc5f","#20cc5f"],
                        ],
                        [
                            'data' =>['0.81', '0.82', '0.8', '0.71', '0.89'], 
                            'label' => 'YouTrack',
                            'backgroundColor' => [
                                'rgba(190, 124, 145, 0.0)'
                            ],
                            'borderColor' =>  [
                                '#960ddb',
                                '#960ddb',
                                '#960ddb',
                                '#960ddb',
                                '#960ddb'
                            ],
                            'borderWidth' => 1,
                            'hoverBorderColor'=>["#960ddb","#960ddb","#960ddb","#960ddb","#960ddb"],
                        ],
                        [
                            'data' =>['0.74', '0.89', '0.74', '0.7', '0.78'], 
                            'label' => 'Redmine',
                            'backgroundColor' => [
                                'rgba(190, 124, 145, 0.0)'
                            ],
                            'borderColor' =>  [
                                '#e00f35',
                                '#e00f35',
                                '#e00f35',
                                '#e00f35',
                                '#e00f35'
                            ],
                            'borderWidth' => 1,
                            'hoverBorderColor'=>["#e00f35","#e00f35","#e00f35","#e00f35","#e00f35"],
                        ],
                        [
                            'data' =>['0.71', '0.86', '0.81', '0.61', '0.71'], 
                            'label' => 'Jira',
                            'backgroundColor' => [
                                'rgba(54, 228, 247, 0.2)',
                            ],
                            'borderColor' =>  [
                                '#36e4f7',
                                '#36e4f7',
                                '#36e4f7',
                                '#36e4f7',
                                '#36e4f7'
                            ],
                            'borderWidth' => 1,
                            'hoverBorderColor'=>["#36e4f7","#36e4f7","#36e4f7","#36e4f7","#36e4f7"],
                        ],
                    ]
                ],
                'clientOptions' => [
                    'legend' => [
                        'display' => true,
                        'position' => 'bottom',
                        'labels' => [
                            'fontSize' => 14,
                            //'fontColor' => 'rgba(0,0,255,0.8)',
                        ]
                    ],
                    'tooltips' => [
                        'enabled' => true,  
                        'intersect' => true
                    ],
                    'hover' => [
                        'mode' => true
                    ],
                    'maintainAspectRatio' => true,
                ],
            ])?>
        </div>
    </div>
    <div class="card card-body" style="height: 25%;width: 25%">
        <div class="card-body">
            <?php
            echo ChartJs::widget([
                'type' => 'radar',
                'options' => [
                    'height' => 200,
                    'width' => 400,
                ],
                'data' => [
                    'labels' => ['Label 1', 'Label 2', 'Label 3'], // Your labels
                    'datasets' => [
                        [
                            'data' => ['35.6', '17.5', '46.9'], // Your dataset
                            'label' => '',
                            'backgroundColor' => [
                                '#ADC3FF',
                                '#FF9A9A',
                                'rgba(190, 124, 145, 0.8)'
                            ],
                            'borderColor' =>  [
                                '#fff',
                                '#fff',
                                '#fff'
                            ],
                            'borderWidth' => 1,
                            'hoverBorderColor'=>["#999","#999","#999"],
                        ]
                    ]
                ],
                'clientOptions' => [
                    'legend' => [
                        'display' => false,
                        'position' => 'bottom',
                        'labels' => [
                            'fontSize' => 14,
                            'fontColor' => "#425062",
                        ]
                    ],
                    'tooltips' => [
                        'enabled' => true,
                        'intersect' => true
                    ],
                    'hover' => [
                        'mode' => false
                    ],
                    'maintainAspectRatio' => false,
                ],
            ])?>
        </div>
    </div>

<?php
/*use phpnt\chartJS\ChartJs;
$dataWeatherOne = [
    'labels' => ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
    'datasets' => [
        [
            'data' => [-14, -10, -4, 6, 17, 23, 22, 22, 13, 2, -5, -12],
            'label' =>  "Линейный график (tºC Урал).",
            'fill' => false,
            'lineTension' => 0.1,
            'backgroundColor' => "rgba(75,192,192,0.4)",
            'borderColor' => "rgba(75,192,192,1)",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "rgba(75,192,192,1)",
            'pointBackgroundColor' => "#fff",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
            'pointHoverBorderColor' => "rgba(220,220,220,1)",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 1,
            'pointHitRadius' => 10,
            'spanGaps' => false,
        ]
    ]
];
$dataWeather = [
        'labels' => ["Підтримка", "Зручність використання", "Ефективність", "Універсальність", "Коректність"],
    'datasets' => [
        [
            'data' => [],
            'label' =>  "Jira",
            'fill' => false,
            'lineTension' => 0.01,
            'backgroundColor' => "rgba(75,192,192,0.4)",
            'borderColor' => "rgba(75,192,192,1)",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "rgba(75,192,192,1)",
            'pointBackgroundColor' => "#fff",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
            'pointHoverBorderColor' => "rgba(220,220,220,1)",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 1,
            'pointHitRadius' => 10,
            'spanGaps' => false,
        ],
        [
            'data' => [],
            'label' =>  "Redmine",
            'fill' => false,
            'lineTension' => 0.01,
            'backgroundColor' => "rgba(75,192,192,0.4)",
            'borderColor' => "rgba(75,192,192,1)",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "rgba(75,192,192,1)",
            'pointBackgroundColor' => "#fff",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
            'pointHoverBorderColor' => "rgba(220,220,220,1)",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 1,
            'pointHitRadius' => 10,
            'spanGaps' => false,
        ],
        [
            'data' => [],
            'label' =>  "YouTrack",
            'fill' => false,
            'lineTension' => 0.01,
            'backgroundColor' => "rgba(75,192,192,0.4)",
            'borderColor' => "rgba(75,192,192,1)",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "rgba(75,192,192,1)",
            'pointBackgroundColor' => "#fff",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
            'pointHoverBorderColor' => "rgba(220,220,220,1)",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 1,
            'pointHitRadius' => 10,
            'spanGaps' => false,
        ],
        [
            'data' => [],
            'label' =>  "Bugzilla",
            'fill' => false,
            'lineTension' => 0.01,
            'backgroundColor' => "rgba(75,192,192,0.4)",
            'borderColor' => "rgba(75,192,192,1)",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "rgba(75,192,192,1)",
            'pointBackgroundColor' => "#fff",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
            'pointHoverBorderColor' => "rgba(220,220,220,1)",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 1,
            'pointHitRadius' => 10,
            'spanGaps' => false,
        ],
        [
            'data' => ['0,71','0,86','0,81','0,61','0,77',],
            'label' =>  "byTrack",
            'fill' => false,
            'lineTension' => 0.1,
            'backgroundColor' => "rgba(75,192,192,0.4)",
            'borderColor' => "rgba(75,192,192,1)",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "rgba(75,192,192,1)",
            'pointBackgroundColor' => "#fff",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
            'pointHoverBorderColor' => "rgba(220,220,220,1)",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 1,
            'pointHitRadius' => 10,
            'spanGaps' => false,
        ],
    ],
];
$dataWeatherTwo = [
    'labels' => ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",  "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
    'datasets' => [
        [
            'data' => [-14, -10, -4, 6, 17, 23, 22, 22, 13, 2, -5, -12],
            'label' =>  "График (tºC Урал).",
            'fill' => true,
            'lineTension' => 0.1,
            'backgroundColor' => "rgba(75,192,192,0.4)",
            'borderColor' => "rgba(75,192,192,1)",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "rgba(75,192,192,1)",
            'pointBackgroundColor' => "#fff",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
            'pointHoverBorderColor' => "rgba(220,220,220,1)",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 1,
            'pointHitRadius' => 10,
            'spanGaps' => false,
        ],
        [
            'data' => [8, 10, 11, 15, 21, 26, 28, 30, 26, 21, 16, 9],
            'label' =>  "График (tºC Сочи).",
            'fill' => true,
            'lineTension' => 0.1,
            'backgroundColor' => "rgba(255, 234, 0,0.4)",
            'borderColor' => "rgba(255, 234, 0,1)",
            'borderCapStyle' => 'butt',
            'borderDash' => [],
            'borderDashOffset' => 0.0,
            'borderJoinStyle' => 'miter',
            'pointBorderColor' => "rgba(255, 234, 0,1)",
            'pointBackgroundColor' => "#fff",
            'pointBorderWidth' => 1,
            'pointHoverRadius' => 5,
            'pointHoverBackgroundColor' => "rgba(255, 234, 0,1)",
            'pointHoverBorderColor' => "rgba(220,220,220,1)",
            'pointHoverBorderWidth' => 2,
            'pointRadius' => 1,
            'pointHitRadius' => 10,
            'spanGaps' => false,
        ]
    ]
];

// вывод графиков
echo ChartJs::widget([
    'type'  => ChartJs::TYPE_LINE,
    //'title' => 'Експертна оцінка якості програмних продуктів',
    'data'  => $dataWeatherTwo,
    'options'   => []
]);/*
echo ChartJs::widget([
    'type'  => ChartJs::TYPE_LINE,
    'data'  => $dataScatter,
    'options'   => [
        'scales' => [
            'xAxes' => [[
                'type' => 'linear',
                'position' => 'bottom'
            ]]
        ]
    ]
]);
echo ChartJs::widget([
    'type'  => ChartJs::TYPE_BAR,
    'data'  => $dataWeatherOne,
    'options'   => []
]);
echo ChartJs::widget([
    'type'  => ChartJs::TYPE_BAR,
    'data'  => $dataWeatherTwo,
    'options'   => []
]);
echo ChartJs::widget([
    'type'  => ChartJs::TYPE_RADAR,
    'data'  => $dataWeather,
    'options'   => []
]);
echo ChartJs::widget([
    'type'  => ChartJs::TYPE_RADAR,
    'data'  => $dataWeatherTwo,
    'options'   => []
]);*/
?>