<?php
function getValidationString($dt)
{
    // string max:21,844
    $arr = [
        'tinyint(4)' => 'numeric|non_fraction|tinyInteger',
        'tinyint(3) unsigned' => 'numeric|non_fraction|tinyIntegerUnsigned',
        'smallint(6)' => 'numeric|non_fraction|smallInteger',
        'smallint(5) unsigned' => 'numeric|non_fraction|smallIntegerUnsigned',
        'mediumint(9)' => 'numeric|non_fraction|mediumInteger',
        'mediumint(8) unsigned' => 'numeric|non_fraction|mediumIntegerUnsigned',
        'int(11)' => 'numeric|non_fraction|integerCustom',
        'int(10) unsigned' => 'numeric|non_fraction|integerCustomUnsigned',
        'bigint(20)' => 'numeric|non_fraction|bigInteger',
        'bigint(20) unsigned' => 'numeric|non_fraction|bigIntegerUnsigned',
        'decimal(8,2)' => 'numeric|decimal:8,2',
        'decimal(8,2) unsigned' => 'numeric|decimal:8,2',
        'double(8,2)' => 'numeric|decimal:8,2',
        'double' => 'numeric',
        'tinyint(1)' => 'boolean',
        'date' => 'date_multi_format:Y-m-d,y-m-d',
        'datetime' => 'date_multi_format:Y-m-d H:i:s,Y-m-d H:i,y-m-d H:i:s,y-m-d H:i,Y-m-d\TH:i',
        'time' => 'date_multi_format:H:i:s,H:i',
        'char(255)' => 'char:10',
        'varchar(255)' => 'string|max:255',
        'text' => 'max:65535',
        'mediumtext' => 'max:16777215',
        'longtext' => 'max:4294967295',
        'blob' => 'max:65535',
        'geometry' => 'geometry',
        'point' => 'point',
        'linestring' => 'linestring',
        'polygon' => 'polygon',
        'multipoint' => 'multipoint',
        'multilinestring' => 'multilinestring',
        'multipolygon' => 'multipolygon',
        'geometrycollection' => 'geometrycollection',
        'varchar(45)' => 'string|max:45',
        'varchar(17)' => 'string|max:17',
        'char(36)' => 'char:36',
        'year(4)' => 'numeric|non_fraction|year',
        'timestamp' => 'date_multi_format:Y-m-d H:i:s,Y-m-d H:i,y-m-d H:i:s,y-m-d H:i,Y-m-d\TH:i',
    ];
    if(empty($arr[$dt])){
        if(strpos($dt, 'ecimal')){
            return 'numeric|decimal:'.str_replace(['decimal(',')'],['',''],$dt);
        }
        if(strpos($dt, 'ouble(')){
            return 'numeric|decimal:'.str_replace(['double(',')'],['',''],$dt);
        }
        if(strpos($dt, 'archar(')){
            return 'string|max:'.str_replace(['varchar(',')'],['',''],$dt);
        }
        if(strpos($dt, 'har(')){
            return 'char:'.str_replace(['char(',')'],['',''],$dt);
        }
        if(strpos($dt, 'num(')){
            return 'in:'.str_replace(['enum(',')',"'",' '],['','','',''],$dt);
        }
        return "";
    }else{
        return $arr[$dt];
    }
}
?>