<?php

function mask_phone($val)
{
    //echo mask($cnpj, '##.###.###/####-##').'<br>';
    //echo mask($cpf, '###.###.###-##').'<br>';
    //echo mask($cep, '#####-###').'<br>';
    //echo mask($data, '##/##/####').'<br>';
    //echo mask($data, '##/##/####').'<br>';
    //echo mask($data, '[##][##][####]').'<br>';
    //echo mask($data, '(##)(##)(####)').'<br>';
    //echo mask($hora, 'Agora são ## horas ## minutos e ## segundos').'<br>';
    //echo mask($hora, '##:##:##');

    $mask = '(##) # ####-####';

    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) {
                $maskared .= $val[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }

    return $maskared;
}

function limit($val, $limit)
{
    return \Illuminate\Support\Str::limit($val, $limit);
}

function date_mask1($date)
{
    $dat = Carbon\Carbon::create($date);
    $mes = $dat->month;
    //dd($mes);
    $meses = array(
        1 => "Jan",
        2 => "Fev",
        3 => "Mar",
        4 => "Abrl",
        5 => "Mai",
        6 => "Jun",
        7 => "Jul",
        8 => "Ago",
        9 => "Set",
        10 => "Out",
        11 => "Nov",
        12 => "Dez"
    );

    return $dat->day . " " . $meses[$mes] . " " . $dat->year;
}
