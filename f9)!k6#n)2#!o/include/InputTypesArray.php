<?php
function getInputTypeArray($td)
{
    $arr = [
        'tinyint(4)' => 'number',
        'tinyint(3) unsigned' => 'number',
        'smallint(6)' => 'number',
        'smallint(5) unsigned' => 'number',
        'mediumint(9)' => 'number',
        'mediumint(8) unsigned' => 'number',
        'int(11)' => 'number',
        'int(10) unsigned' => 'number',
        'bigint(20)' => 'number',
        'bigint(20) unsigned' => 'number',
        'decimal(8,2)' => 'number',
        'decimal(8,2) unsigned' => 'number',
        'double(8,2)' => 'number',
        'double' => 'number',
        'tinyint(1)' => 'number',
        'datetime' => 'datetime-local',
        'date' => 'date',
        'time' => 'time',
        'char(255)' => 'text',
        'varchar(255)' => 'text',
        'tinytext' => 'text',
        'text' => 'text',
        'smalltext' => 'text',
        'mediumtext' => 'text',
        'longtext' => 'text',
        'tinyblob' => 'text',
        'blob' => 'text',
        'smallblob' => 'text',
        'mediumblob' => 'text',
        'longblob' => 'text',
        'geometry' => 'text',
        'point' => 'text',
        'linestring' => 'text',
        'polygon' => 'text',
        'multipoint' => 'text',
        'multilinestring' => 'text',
        'multipolygon' => 'text',
        'geometrycollection' => 'text',
        'varchar(45)' => 'text',
        'varchar(17)' => 'text',
        'char(36)' => 'text',
        'year(4)' => 'number',
        'timestamp' => 'datetime-local'
    ];
    foreach ($td as $k => $v) {
        if(empty($arr[$v['Type']])){
            if(strpos($v['Type'], 'ecimal')){
                $arr[$v['Type']] = 'number';
                $t=explode(",", str_replace(['decimal(',')'],['',''],$v['Type']));
                $deciArr[$v['Type']] = '0.'.str_pad("1", $t[1],"0",STR_PAD_LEFT);
            }else if(strpos($v['Type'], 'ouble(')){
                $arr[$v['Type']] = 'number';
                $t=explode(",", str_replace(['double(',')'],['',''],$v['Type']));
                $deciArr[$v['Type']] = '0.'.str_pad("1", $t[1],"0",STR_PAD_LEFT);
            }else if(strpos($v['Type'], 'archar(')){
                $arr[$v['Type']] = 'text';
            }else if(strpos($v['Type'], 'har(')){
                $arr[$v['Type']] = 'text';
            }
        }
    }
    return $arr;
}

function getTextAreaTypes()
{
    return [
        'text' => '2',
        'mediumtext' => '3',
        'longtext' => '5',
        'blob' => '5',
    ];
}

function getDecimalTypes()
{
    return $deciArr;
}

$deciArr = [
    'decimal(8,2)' => '0.01',
    'decimal(8,2) unsigned' => '0.01',
    'double(8,2)' => '0.01',
    'double' => 'any',
];
?>