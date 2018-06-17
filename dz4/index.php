<?php

require_once './app/base_tariff.php';
require_once './app/hour_tariff.php';
require_once './app/hours24_tariff.php';
require_once './app/students_tariff.php';

use App\BaseTariff;
use App\HourTariff;
use App\Hours24Tariff;
use App\StudentsTariff;

/**
 *  Ниже показаны примеры вызовов по разным тарифам.
 *  При вызове указать время в минутах.
 *  Для подключения дополнительных услуг:
 *  - на тарифах Базовый и Студентческий доступна услуга "GPS",
 *   при вызове передать в options значение 'GPS';
 *  - на тарифах Почасовой и Посуточный доступны услуги "GPS" и дополнительный водитель, при вызове
 *   передать в массив options значения 'GPS' и 'DRIVER_PLUS' соответственно;
 */
echo '<p>вызов 1: ';
$base1 =  new BaseTariff(10, 40, 22, 'not');
echo  '</p>';

echo '<p>вызов 2: ';
$base2 =  new BaseTariff(10, 30, 21, 'GPS');
echo  '</p>';

echo '<p>вызов 3: ';
$base3 = new BaseTariff(15, 130, 66, ' не нужно');
echo  '</p>';

echo '<p>вызов 4: ';
$hours1 = new HourTariff(300, 21,['GPS']);
echo  '</p>';

echo '<p>вызов 5: ';
$hours2 = new HourTariff(120, 25, ['DRIVER_PLUS', 'GPS']);
echo  '</p>';

echo '<p>вызов 6: ';
// 1440 минут = сутки, 1469 минут = 1 сутки 29 минут
$days1 = new Hours24Tariff(10, 1469, 45, ['GPS', 'DRIVER_PLUS']);
echo  '</p>';

echo '<p>вызов 7: ';
$days2 = new Hours24Tariff(100, 1000, 21, ['нет']);
echo  '</p>';

echo '<p>вызов 8: ';
$student1 = new StudentsTariff(10, 30, 21, 'GPS');
echo  '</p>';

echo '<p>вызов 9: ';
$student2 = new StudentsTariff(15, 20, 27, 'GPS');
echo  '</p>';
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Четвертое домашнее задание от loftschool.com по PHP</title>
</head>
<body>
<div class="container">
    <h1 class="title">Четвертое домашнее задание от loftschool.com по PHP</h1>
    <div class="task-wrapper">
        <h3 class="title">Примеры расчета по базовому тарифу:</h3>
        <table>
            <tr>
                <th>1.</th>
                <th>Расчет по тарифу базовый (10км, 40 минут, 22 года, без опций)</th>
                <th><?= $base1->tariffCalculation(); ?></th>
                <th>Pyб.</th>
            </tr>
            <tr>
                <th>2.</th>
                <th>Расчет по тарифу базовый (10км, 30 минут, 21 год, c GPS)</th>
                <th><?=$base2->tariffCalculation(); ?></th>
                <th>Pyб.</th>
            </tr>
            <tr>
                <th>3.</th>
                <th>Расчет по тарифу базовый (15км, 130 минут, 66 лет, без опций)</th>
                <th><?=$base3->tariffCalculation(); ?></th>
                <th>Pyб.</th>
            </tr>
            </table>
    </div>
    <div class="task-wrapper">
        <h3 class="title">Примеры расчета по по-часовому тарифу:</h3>
        <table>
            <tr>
                <th>4.</th>
                <th>Расчет по тарифу почасовой (300 минут, 21 год, с GPS)</th>
                <th><?=$hours1->tariffCalculation(); ?></th>
                <th>Pyб.</th>
            </tr>
            <tr>
                <th>5.</th>
                <th>Расчет по тарифу почасовой (120 минут, 25 лет, с GPS и доп. водителем)</th>
                <th><?=$hours2->tariffCalculation(); ?></th>
                <th>Pyб.</th>
            </tr>
        </table>
    </div>
    <div class="task-wrapper">
        <h3 class="title">Примеры расчета по суточному тарифу:</h3>
        <table>
            <tr>
                <th>6.</th>
                <th>Расчет по тарифу суточный (10км, 1469 минут, 45 лет, с GPS и доп. водителем)</th>
                <th><?=$days1->tariffCalculation(); ?></th>
                <th>Pyб.</th>
            </tr>
            <tr>
                <th>7.</th>
                <th>Расчет по тарифу суточный (100км, 1000 минут, 21 год, без доп. опций)</th>
                <th><?=$days2->tariffCalculation(); ?></th>
                <th>Pyб.</th>
            </tr>
        </table>
    </div>
    <div class="task-wrapper">
        <h3 class="title">Примеры расчета по cтудентческому тарифу:</h3>
        <table>
            <tr>
                <th>8.</th>
                <th>Расчет по тарифу студентческий (10км, 30 минут, 21 год, с GPS)</th>
                <th><?=$student1->tariffCalculation(); ?></th>
                <th>Pyб.</th>
            </tr>
            <tr>
                <th>9.</th>
                <th>Расчет по тарифу студентческий (15км, 20 минут, 27 лет, с GPS)</th>
                <th><?=$student2->tariffCalculation(); ?></th>
                <th>Pyб.</th>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
