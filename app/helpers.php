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
